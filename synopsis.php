<php?
	class Synopsis {
	
		private $id; // the synopsis id
		private $name; // the movie name
		private $author; // the author of the synopsis
		private $upvotes; // the number of upvotes
		private $downvotes; // the number of downvotes
		private $entryTimes; // the list of times in order
		private $entries; // the entries
		
		// the constructor
		public function __construct($i, $n, $a, $u, $d, $eTj, $e) {
			
			$this -> id = $i;
			$this -> name = $n;
			$this -> author = $a;
			$this -> upvotes = $u;
			$this -> downvotes = $d;
			$this -> entryTimes = $eT;
			$this -> entries -> $e;
		}// __construct
		
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
		
		// adds an upvote 
		public function addUpvote() {
		
			$this -> upvotes ++;
			return $this -> upvotes

		} //addUpvote
		
		// add a downvote
		public function addDownvote() {
		
			return ++($this -> downvotes);
		}
		
		// adds an entry to the synopsis
		function addEntry($val) { 
			array_push($entryTimes, $val[0]);
			$entries[$val[0]] = $val[9];
			$entryTimes = array_values($entryTimes);
		}// addEntry
	
		// removes and entry to the synopsis
		function removeEntry $val) { 
			if(in_array($val[0],$entryTimes) == true) { 
				foreach($entryTimes as $key=>$value){
					
					if $value == $val[0]) unset($array[$key]);
				}// for each
				
				foreach($entries as $key => $value){
					
					if($key == $val[0]) unset($entries[$key]);
				}// foreach
					
				$entryTimes = array_values($entryTimes);					
			}// if
		}// removeEntry
	}// class Synopsis
?>