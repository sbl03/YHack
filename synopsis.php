<html>
<?php
	class Synopsis {
                private static $dbtype = "mysql";
                private static $dbhost = "localhost";
                private static $dbname = "yhacks";
                private static $dbuser = "root";
                private static $tbname = "synopsis";
                private static $tbname2 = "entry";
		private $id; // the synopsis id
		private $name; // the movie name
		private $author; // the author of the synopsis
		private $upvotes; // the number of upvotes
		private $downvotes; // the number of downvotes
		private $entryTimes; // the list of times in order
		private $entries; // the entries
		
		// the constructor
		private function __construct($i, $n, $a, $u, $d, $eT, $e) {
			
			$this -> id = $i;
			$this -> name = $n;
			$this -> author = $a;
			$this -> upvotes = $u;
			$this -> downvotes = $d;
			$this -> entryTimes = $eT;
			$this -> entries = $e;
		}// __construct
		
		//returns a new synopsis
		public static function createNew($n, $a, $eT, $e){
                        
                        $conn = new PDO("mysql:host=".Synopsis::$dbhost.";dbname=".Synopsis::$dbname, Synopsis::$dbuser,"");

                        $insert = "INSERT INTO ".Synopsis::$tbname." (MovieName, Author, Upvotes, Downvotes) VALUES ('$n', '$a', 0, 0)";
                        $x = $conn->prepare($insert);
                        $x->execute();
                        $get = "SELECT ID FROM ".Synopsis::$tbname." ORDER BY ID DESC";
                        $q = $conn->prepare($get);
                        $q->execute();
                        $ids = $q->fetchAll();
                        $i = array_shift(array_shift($ids));
                        foreach($e as $key => $value){
                            $ent = "INSERT INTO ".Synopsis::$tbname2." (ID, Time, Text) VALUES ($i, $key, '$value')";
                            $y = $conn->prepare($ent);
                            $y->execute();
                        }
			return new Synopsis($i, $n, $a, 0, 0, $eT, $e);
		}// createNew
		
		//returns the synopsis with id $i
		public static function retreive($i){
		
			$conn = new PDO("mysql:host=".Synopsis::$dbhost.";dbname=".Synopsis::$dbname, Synopsis::$dbuser,"");
                        $insert = "SELECT * FROM ".Synopsis::$tbname." WHERE ID = ".$i;
                        $x = $conn->prepare($insert);
                        $x->execute();
                        $data = $x -> fetchAll();
                        
                        $data = array_shift($data);
                        $i = $data[0];
                        $n = $data[1];
                        $a = $data[2];
                        $u = $data[3];
                        $d = $data[4];
                        
                        $insert = "SELECT * FROM ".Synopsis::$tbname2." WHERE ID = ".$i;
                        $x = $conn->prepare($insert);
                        $x->execute();
                        $eData = $x -> fetchAll();
                        $eT = array();
                        $e = array();
                        
                        foreach ($eData as $key => $value){
                            
                            array_unshift($eT, $value[1]);
                            $e[$value[1]] = $value[2];
                        }// foreach
                        
                        array_values($eT);
                        
			return new Synopsis($i, $n, $a, $u, $d, $eT, $e);
		}// retrieve
		
		// returns synopsis id
		public function getID() {
			
			return $this -> id;
		}// getID
		
		// retuns the movie name
		public function getName() {
			
			return $this -> name;
		}// getName
		
		// returns the synopsis authorj
		public function getAuthor() {
		
			return $this -> author;
		}// getAuthor
		
		// returns the number of upvotes
		public function getUpvotes() {
		
			return $this -> upvotes;
		}// getUpvotes
		
		// returns the number of downvotes
		public function getDownvotes() {
			
			return $this -> downvotes;
		}// getDownvotes
		
                // returns the entries list
                public function getEntries(){
                    
                    return $this -> entries;
                }// getEntries
            
		// adds an upvote 
		public function addUpvote() {
		
			$this -> upvotes ++;
                        $conn = new PDO("mysql:host=".Synopsis::$dbhost.";dbname=".Synopsis::$dbname, Synopsis::$dbuser,"");
                        $insert = "UPDATE ".Synopsis::$tbname." SET Upvotes = ".$this -> upvotes." WHERE ID = ".$this -> id;
                        $x = $conn->prepare($insert);
                        $x->execute();
                        
			return $this -> upvotes;
		} //addUpvote
		
		// add a downvote
		public function addDownvote() {
		
			$this -> downvotes ++;
                        $conn = new PDO("mysql:host=".Synopsis::$dbhost.";dbname=".Synopsis::$dbname, Synopsis::$dbuser,"");
                        $insert = "UPDATE ".Synopsis::$tbname." SET Downvotes = ".$this -> downvotes." WHERE ID = ".$this -> id;
                        $x = $conn->prepare($insert);
                        $x->execute();
			return $this -> downvotes;
		}
		
		// adds an entry to the synopsis
		function addEntry($val) { 
			array_push($entryTimes, $val[0]);
			$entries[$val[0]] = $val[1];
			$entryTimes = array_values($entryTimes);
		}// addEntry
	
		// removes and entry to the synopsis
		function removeEntry ($val) { 
			if(in_array($val[0],$entryTimes) == true) { 
				foreach($entryTimes as $key=>$value){
					
					if($value == $val[0]) unset($array[$key]);
				}// for each
				
				foreach($entries as $key => $value){
					
					if($key == $val[0]) unset($entries[$key]);
				}// foreach
					
				$entryTimes = array_values($entryTimes);					
			}// if
		}// removeEntry
	}// class Synopsis
	
	$entryT = array(1, 15, 52);
	$entries = array(1 => "test", 15 => "Hello", 52 => "the thing");
	$test = Synopsis::createNew("test", "Wasson", $entryT, $entries);
        $test -> addUpvote();
        $test -> addDownvote();
        $test2 = Synopsis::retreive(50);
        print_r($test2 -> getEntries());
        
?>
</html>