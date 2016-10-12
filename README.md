# Main repo for Team 11, Fall 2016

* **PM**: Joseph Costa
* **CTO**: Ed Young
* Martha Leticia Gomez
* Yuning Hong
* Josh Rubin
* Ryan Tang

------------

# Coding conventions

* Variables and functions should be named in `camelCase` and *not* `snake_case`. (Exception: PHP functions should be written in `snake_case`.)
* Quotations should be **single quotes** `'`, unless double quotes `"` are needed (such as PHP string interpolation).
* Indentation should be **tabs only**, unless aligning SQL queries with spaces.
* Braces should be preceded by a space, written in the following manner, and are **required** even if it only encapsulates one line of code, like so:

    function queryDb($query) {
    	// Some code
    	if ($condition1) {
    		// code here
    	} elseif ($conditional2) {
    		// code here
    	} else {
    		// code here
    	}
    }

* SQL queries should be written on multiple lines (unless the query is extremely short).
* Operators (`&&`, `||`, `==`, `+`, `-`, and so on) should be spaced apart from the rest of the expression. (Includes PHP `.`, excludes SQL statements)
* Filenames should be written as `application-controller` instead of `application_controller` or `applicationController`.

### Example code snippet


    <?php
    	function find_users_by_name($name): array {
    		$name = trim($name);
    		if (empty($name)) {
    			echo 'Empty string passed into find_users_by_name';
    			return [];
    		}
    		$servername = 'localhost';
    		$username = 'username';
    		$password = 'password';

    		$firstName = '';
    		$lastName = '';

    		$pieces = explode(' ', $name);
    		switch (count($pieces)) {
    			echo 'Empty string passed into find_users_by_name';
    			case 0:
    				return [];
    			case 1:
    				$firstName = $pieces[0];
    				break;
    			default:
    				$firstName = $pieces[0];
    				$lastName = implode(' ', array_slice($pieces, 1));
    				break;
    		}
    		
    		try {
    			$conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    			// set the PDO error mode to exception
    			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    			$query = "SELECT *" .
    			         "FROM Users" .
    			         "WHERE firstname=$firstName";
    			if (!empty($lastName)) {
    				$query = $query . " AND lastname=$lastName";
    			}

    			$queryResult = $conn->query($query);
    			$results = $queryResult->fetchAll();
    			return $results;
    		}
    		catch (PDOException $e) {
    			echo "Connection failed: " . $e->getMessage();
    		}
    	}
    ?>


