<div class="container">
  <h2>all information</h2>          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>USERNAME</th>
        <th>EMAIL</th>
        <th>PASSWORD</th>
      </tr>
    </thead>
    <tbody>
    <?php
   	$conn = new mysqli("202.166.198.46","learner","learner","db_ewallet");
    $sql= "SELECT * FROM user";
    $result =mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result))
	    {
		    echo "<tr>";
			    echo"<td>".$row['username']."</td>";
			    echo"<td>".$row['email']."</td>";
			    echo"<td>".$row['password']."</td>";
		    echo"</tr>";
	  	}
     ?>
    </tbody>
  </table>
</div>
