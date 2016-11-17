<html>
  <head>
  	<!--Handles how big the map appears on the page-->
    <style>
    </style>
  </head>
  <body>
    <form action="<?php echo URL; ?>listing_controller" method="post">
      Street Number: <input type="text" name="streetNo"><br>
      Street Name: <input type="text" name="streetName"><br>
      City: <input type="text" name="city"><br>
      Zip Code: <input type="text" name="zipCode"><br>
      Bedrooms: <input type="text" name="bedrooms"><br>
      Baths: <input type="text" name="baths"><br>
      Square Feet: <input type="text" name="sqFt"><br>
      Monthly Rent: <input type="text" name="monthlyRent"><br>
      Description: <input type="text" name="description"><br>
      Deposit: <input type="text" name="deposit"><br>
      petDeposit: <input type="text" name="petDeposit"><br>
      keyDeposit: <input type="text" name="keyDeposit"><br>
      electricity: <input type="text" name="electricity"><br>
      internet: <input type="text" name="internet"><br>
      water: <input type="text" name="water"><br>
      gas: <input type="text" name="gas"><br>
      television: <input type="text" name="television"><br>
      pets: <input type="text" name="pets"><br>
      smoking: <input type="text" name="smoking"><br>
      furnished: <input type="text" name="furnished"><br>
      start date: <input type="text" name="startDate"><br>
      end date: <input type="text" name="endDate"><br>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>