<?php
    class Post {
        private $conn;
        private $table= 'subjects';

        //Propiedades 
        public $id_subject;
        public $semester;
        public $name_subject;
        public $credits;
        public $code;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Obtener Posts 
        public function read(){
            //Crear query
            $query='SELECT id_subject, semester, name_subject,credits,code
                FROM
                    ' . $this->table;

            //Preparar statement
            $stmt = $this->conn->prepare($query);

            //Ejecutar query 
            $stmt->execute();

            return $stmt;
        }

        public function read_single(){
            //Create a query
            $query = 'SELECT  id_subject, semester, name_subject, credits, code
            FROM ' . $this->table . ' 
            WHERE
             id_subject = ?
            LIMIT 0,1';

            //Prepare statement 
            $stmt = $this->conn->prepare($query);
            //Bind ID
            $stmt->bindParam(1, $this->id_subject);
            // Execute query
            $stmt->execute();
           
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties

            $this->semester = $row['semester'];
            $this->name_subject = $row['name_subject'];
            $this->credits = $row['credits'];
            $this->code = $row['code'];
            
        }   

        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . ' SET semester = :semester, name_subject = :name_subject, credits = :credits, code = :code';
  
            // Prepare statement
            $stmt = $this->conn->prepare($query);
  
            // Clean data
            $this->semester = htmlspecialchars(strip_tags($this->semester));
            $this->name_subject = htmlspecialchars(strip_tags($this->name_subject));
            $this->credits = htmlspecialchars(strip_tags($this->credits));
            $this->code = htmlspecialchars(strip_tags($this->code));
  
            // Bind data
            $stmt->bindParam(':semester', $this->semester);
            $stmt->bindParam(':name_subject', $this->name_subject);
            $stmt->bindParam(':credits', $this->credits);
            $stmt->bindParam(':code', $this->code);
  
            // Execute query
            if($stmt->execute()) {
              return true;
        }
  
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
  
        return false;
      }

			public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET semester = :semester,  name_subject= :name_subject, credits = :credits, code = :code
                              WHERE id_subject = :id_subject';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->semester = htmlspecialchars(strip_tags($this->semester));
        $this->name_subject = htmlspecialchars(strip_tags($this->name_subject));
        $this->credits = htmlspecialchars(strip_tags($this->credits));
        $this->code = htmlspecialchars(strip_tags($this->code));
        $this->id_subject = htmlspecialchars(strip_tags($this->id_subject));

        // Bind data
        $stmt->bindParam(':semester', $this->semester);
        $stmt->bindParam(':name_subject', $this->name_subject);
        $stmt->bindParam(':credits', $this->credits);
        $stmt->bindParam(':code', $this->code);
        $stmt->bindParam(':id_subject', $this->id_subject);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

		public function delete() {
			// Create query
			$query = 'DELETE FROM ' . $this->table . ' WHERE id_subject = :id_subject';

			// Prepare statement
			$stmt = $this->conn->prepare($query);

			// Clean data
			$this->id = htmlspecialchars(strip_tags($this->id_subject));

			// Bind data
			$stmt->bindParam(':id_subject', $this->id_subject);

			// Execute query
			if($stmt->execute()) {
				return true;
			}

			// Print error if something goes wrong
			printf("Error: %s.\n", $stmt->error);

			return false;
}

    }