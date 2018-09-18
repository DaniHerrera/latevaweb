<?php

class Post {

  private $id;
  private $title;
  private $content;
  private $date;

  private $conn;

  public function __construct($servername,$username,$password,$dbname){

    $this->servername = $servername;
    $this->username = $username;
    $this->password = $password;
    $this->dbname = $dbname;

    // Create connection
    $this->conn = mysqli_connect($this->servername,$this->username, $this->password,$this->dbname);
    // Check connection
    if (!$this->conn){
           die("Connection failed: " . mysqli_connect_error());
    }
  }

  
  public function selectAllPosts(){

      $allPosts = '';
      $sql = ("SELECT * FROM posts");
      $result = mysqli_query($this->conn, $sql);

      if (!mysqli_num_rows($result) > 0) {
        return  "0 results";
       }

      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
            $allPosts.= "<tr>";
              $allPosts.= "<td>".$row["title"]."</td>"."<td>".$row["content"]."</td>"."<td>".$row["created_at"]."</td>";
              $allPosts.= "<td><button type='button' data-id='".$row["id"]."'  data-title='".$row["title"]."'  data-content='".$row["content"]."' data-fecha='".$row["created_at"]."' class='updateButton btn btn-primary'>Update</button></td>";
              $allPosts.= "<input id='hiddenId' name='hiddenId' type='hidden' value='".$row["id"]."'>";
            $allPosts.= "</tr>";
          }

      return $allPosts;


  }


  public function insertPost($title,$content){

      $sql = "INSERT INTO posts (title,content) VALUES ('$title','$content')";

      if (!mysqli_query($this->conn, $sql)) {
         return  "Error: " . $sql . "<br>" . mysqli_error($this->conn);
      } 
      return  "New record created successfully";

  }

  public function updatePost($id,$title,$content,$fecha){

      $sql = "UPDATE posts SET title='$title' ,content='$content', created_at='$fecha' WHERE id='$id'";

      if (!mysqli_query($this->conn, $sql)) {
        return  "Error updating record: " . mysqli_error($this->conn);
      } 
        
      return "Record updated successfully";
  }

}

?>
