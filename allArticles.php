<?php
  $host = 'localhost';
  $dbname = 'blog';
  $username = 'root';
  $password = 'root';
    
  $dsn = "mysql:host=$host;dbname=$dbname"; 
  // récupérer tous les utilisateurs
  $sql = "SELECT * FROM articles";
   
  try{
   $pdo = new PDO($dsn, $username, $password);
   $stmt = $pdo->query($sql);
   
   if($stmt === false){
    die("Erreur");
   }
   
  }catch (PDOException $e){
    echo $e->getMessage();
  }
?>

<?php
  $admin = 'root';
  $pass = 'root';
    
  $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=UTF8', $admin, $pass);

  // récupérer tous les utilisateurs
  $sql = "SELECT * FROM articles";
   
  try{
   $pdo = new PDO($dsn, $username, $password);
   $stmt = $pdo->query($sql);
   
   if($stmt === false){
    die("Erreur");
   }
   
  }catch (PDOException $e){
    echo $e->getMessage();
  }
?>

<div class='card'>
<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
    <h4><?php echo htmlspecialchars(strtoupper($row['title'])); ?></h4>
    <p><?php echo htmlspecialchars(strtolower($row['content'])); ?></p>
    <?php endwhile; ?>
</div>