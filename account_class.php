<?php

	class Account
	{
		/* Class properties (variables) */
		
		/* The ID of the logged in account (or NULL if there is no logged in account) */
		private $id;
		
		/* The name of the logged in account (or NULL if there is no logged in account) */
		private $name;

		/* TRUE if the user is authenticated, FALSE otherwise */
		private $authenticated;
		
		
		/* Public class methods (functions) */

		/* Pour avoir la possibilité de créer un compte, veiller à ajouter les fonctions suivantes : addAccount(), isNameValid(), isPasswdValid(), getIdFromName(), et si vous voulez toute la panoplie pour éditer/supprimer ajouter les fonctions suivantes : editAccount(), isIdValid, deleteAccount() */

		/* A sanitization check for the account username */
		public function isNameValid(string $name): bool
		{
			/* Initialize the return variable */
			$valid = TRUE;
			
			/* Example check: the length must be between 8 and 16 chars */
			$len = mb_strlen($name);
			
			if (($len < 1) || ($len > 160))
			{
				$valid = FALSE;
			}
			
			/* You can add more checks here */
			
			return $valid;
		}

		/* A sanitization check for the account password */
		public function isPasswdValid(string $passwd): bool
		{
			/* Initialize the return variable */
			$valid = TRUE;
			
			/* Example check: the length must be between 8 and 16 chars */
			$len = mb_strlen($passwd);
			
			if (($len < 1) || ($len > 160))
			{
				$valid = FALSE;
			}
			
			/* You can add more checks here */
			
			return $valid;
		}

		/* Login with username and password */
		public function login(string $name, string $passwd): bool
		{
			/* Global $pdo object */
			global $pdo;	
			
			/* Trim the strings to remove extra spaces */
			$name = trim($name);
			$passwd = trim($passwd);
			
			/* Check if the user name is valid. If not, return FALSE meaning the authentication failed */
			if (!$this->isNameValid($name))
			{
				return FALSE;
			}
			
			/* Check if the password is valid. If not, return FALSE meaning the authentication failed */
			if (!$this->isPasswdValid($passwd))
			{
				return FALSE;
			}
			
			/* Look for the account in the db. Note: the account must be enabled (account_enabled = 1) */
			$query = 'SELECT * FROM accounts WHERE (account_name = :name) AND (account_enabled = 1)';
			
			/* Values array for PDO */
			$values = array(':name' => $name);
			
			/* Execute the query */
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
			   /* If there is a PDO exception, throw a standard exception */
			   throw new Exception('Database query error');
			}
			
			$row = $res->fetch(PDO::FETCH_ASSOC);
			
			/* If there is a result, we must check if the password matches using password_verify() */
			if (is_array($row))
			{
				if (password_verify($passwd, $row['account_passwd']))
				{
					/* Authentication succeeded. Set the class properties (id and name) */
					$this->id = intval($row['account_id'], 10);
					$this->name = $name;
					$this->authenticated = TRUE;
					
					/* Register the current Sessions on the database */
					$this->registerLoginSession();
					
					/* Finally, Return TRUE */
					return TRUE;
				}
			}
			
			/* If we are here, it means the authentication failed: return FALSE */
			return FALSE;
		}

		/* Saves the current Session ID with the account ID */
		private function registerLoginSession()
		{
			/* Global $pdo object */
			global $pdo;
			
			/* Check that a Session has been started */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* 	Use a REPLACE statement to:
					- insert a new row with the session id, if it doesn't exist, or...
					- update the row having the session id, if it does exist.
				*/
				$query = 'REPLACE INTO account_sessions (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
				$values = array(':sid' => session_id(), ':accountId' => $this->id);
				
				/* Execute the query */
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
				   /* If there is a PDO exception, throw a standard exception */
				   throw new Exception('Database query error');
				}
			}
		}

		/* Login using Sessions */
		public function sessionLogin(): bool
		{
			/* Global $pdo object */
			global $pdo;
			
			/* Check that the Session has been started */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* 
					Query template to look for the current session ID on the account_sessions table.
					The query also make sure the Session is not older than 7 days
				*/
				$query = 
				
				'SELECT * FROM account_sessions, accounts WHERE (account_sessions.session_id = :sid) ' . 
				'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' . 
				'AND (accounts.account_enabled = 1)';
				
				/* Values array for PDO */
				$values = array(':sid' => session_id());
				
				/* Execute the query */
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
				   /* If there is a PDO exception, throw a standard exception */
				   throw new Exception('Database query error');
				}
				
				$row = $res->fetch(PDO::FETCH_ASSOC);
				
				if (is_array($row))
				{
					/* Authentication succeeded. Set the class properties (id and name) and return TRUE*/
					$this->id = intval($row['account_id'], 10);
					$this->name = $row['account_name'];
					$this->authenticated = TRUE;
					
					return TRUE;
				}
			}
			
			/* If we are here, the authentication failed */
			return FALSE;
		}

		/* Logout the current user */
		public function logout()
		{
			/* Global $pdo object */
			global $pdo;	
			
			/* If there is no logged in user, do nothing */
			if (is_null($this->id))
			{
				return;
			}
			
			/* Reset the account-related properties */
			$this->id = NULL;
			$this->name = NULL;
			$this->authenticated = FALSE;
			
			/* If there is an open Session, remove it from the account_sessions table */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* Delete query */
				$query = 'DELETE FROM account_sessions WHERE (session_id = :sid)';
				
				/* Values array for PDO */
				$values = array(':sid' => session_id());
				
				/* Execute the query */
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
				   /* If there is a PDO exception, throw a standard exception */
				   throw new Exception('Database query error');
				}
			}
		}

		/* "Getter" function for the $authenticated variable
		    Returns TRUE if the remote user is authenticated */
		public function isAuthenticated(): bool
		{
			return $this->authenticated;
		}

		/* Close all account Sessions except for the current one (aka: "logout from other devices") */
		public function closeOtherSessions()
		{
			/* Global $pdo object */
			global $pdo;
			
			/* If there is no logged in user, do nothing */
			if (is_null($this->id))
			{
				return;
			}
			
			/* Check that a Session has been started */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* Delete all account Sessions with session_id different from the current one */
				$query = 'DELETE FROM account_sessions WHERE (session_id != :sid) AND (account_id = :account_id)';
				
				/* Values array for PDO */
				$values = array(':sid' => session_id(), ':account_id' => $this->id);
				
				/* Execute the query */
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
					/* If there is a PDO exception, throw a standard exception */
					throw new Exception('Database query error');
				}
			}
		}

		
		
		/* Constructor */
		public function __construct()
		{
			/* Initialize the $id and $name variables to NULL */
			$this->id = NULL;
			$this->name = NULL;
			$this->authenticated = FALSE;
		}
		
		/* Destructor */
		public function __destruct()
		{
			
		}
	}
?>