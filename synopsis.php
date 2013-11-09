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
		private $start; // the time the movies synopsis starts
		private $upvotes; // the number of upvotes
		private $downvotes; // the number of downvotes
		private $entryTimes; // the list of times in order
		private $entries; // the entries
		
		// the constructor
		private function __construct($i, $n, $a, $s, $u, $d, $eT, $e) {
			
			$this -> id = $i;
			$this -> name = $n;
			$this -> author = $a;
			$this -> start = $s;
			$this -> upvotes = $u;
			$this -> downvotes = $d;
			$this -> entryTimes = $eT;
			$this -> entries = $e;
		}// __construct
		
		//returns a new synopsis
		public static function createNew($n, $a, $s, $eT, $e){
                        
                        $conn = new PDO("mysql:host=".Synopsis::$dbhost.";dbname=".Synopsis::$dbname, Synopsis::$dbuser,"");

                        $insert = "INSERT INTO ".Synopsis::$tbname." (MovieName, Author, Start, Upvotes, Downvotes) VALUES ('$n', '$a', $s, 0, 0)";
                        $x = $conn->prepare($insert);
                        $x->execute();
                        $get = "SELECT ID FROM ".Synopsis::$tbname." ORDER BY ID DESC";
                        $q = $conn->prepare($get);
                        $q->execute();
                        $ids = $q->fetchAll();
                        print_r($ids);
			$temp = array_shift($ids);
                        $i = array_shift($temp);
                        foreach($e as $key => $value){
                            $ent = "INSERT INTO ".Synopsis::$tbname2." (ID, Time, Text) VALUES ($i, $key, '$value')";
                            $y = $conn->prepare($ent);
                            print_r($y->errorInfo());
                            $y->execute();
                        }
			return new Synopsis($i, $n, $a, $s, 0, 0, $eT, $e);
		}// createNew
		
		//returns the synopsis with id $i
		public static function retreive($i){
		
			$conn = new PDO("mysql:host=".Synopsis::$dbhost.";dbname=".Synopsis::$dbname, Synopsis::$dbuser,"");
			$insert = "SELECT * FROM ".Synopsis::$tbname." WHERE ID = $i";
			$x = $conn->prepare($insert);
			$x->execute();
			$data = $x -> fetchAll();
			
			$data = array_shift($data);
			
			$i = $data[0];
			$n = $data[1];
			$a = $data[2];
			$s = $data[3];
			$u = $data[4];
			$d = $data[5];
			
			$insert = "SELECT * FROM ".Synopsis::$tbname2." WHERE ID = ".$i;
			$x = $conn->prepare($insert);
			$x->execute();
			$eData = $x -> fetchAll();
			$eT = array();
			$e = array();
			
			foreach ($eData as $key => $value){
				
				array_push($eT, $value[1]);
				$e[$value[1]] = $value[2];
			}// foreach
			
			array_values($eT);
			
			return new Synopsis($i, $n, $a, $s, $u, $d, $eT, $e);
		}// retrieve
		
		// returns a list of synopsii with the name passed in
		public static function search($name){
			
			$conn = new PDO("mysql:host=".Synopsis::$dbhost.";dbname=".Synopsis::$dbname, Synopsis::$dbuser,"");
			$insert = "SELECT ID FROM ".Synopsis::$tbname." WHERE UCASE(MovieName) = UCASE('$name')";
            $x = $conn->prepare($insert);
            $x->execute();
            $data = $x -> fetchAll();
			$toReturn = array();
			foreach($data as $key => $value){
				
				array_push($toReturn, Synopsis::retreive($value[0]));
			}// foreach
			
			return $toReturn;
		}// search
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
		
		// returns the start time of the synopsis
		public function getStart(){
		
			return $this -> start;
		}//getStart
		
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
	
		// returns the entry times
		public function getETimes(){
		
			return $this -> entryTimes;
		}// getETimes
	
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
		}// addDownvote
		
		//static vertions of addUpvote/Downvote
		public static function vote($id, $type){
		
			$syn = Synopsis::retreive($id);
			
			if ($type == 0){
				$syn -> addUpvote();
				}
			else{			
				$syn -> addDownvote();
				}
			return $syn -> getUpvotes() - $syn -> getDownvotes();
		}// vote
		
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
	
	// $entryT = array(1, 15, 52);
	// $entries = array(1 => "test", 15 => "Hello", 52 => "the thing");
	// $test = Synopsis::createNew("Finding Nemo", "Wasson", 40, $entryT, $entries);
        // $test -> addUpvote();
		// $test -> addUpvote();
		// $test -> addUpvote();
		// $test -> addUpvote();
		// $test -> addUpvote();
		// $test -> addUpvote();
		// $test -> addUpvote();
        // $test -> addDownvote();
		
	// Synopsis::vote(23, 0);
	// Synopsis::vote(22, 1);
?>
</html>