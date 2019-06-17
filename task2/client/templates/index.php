<html>
<head>
	<title>%TITLE%</title>
	<style>
       .ErrorMsg { 
        font-size: 10px; 
        color: #f00;
       }
       
       .box {
        width: 200px;
       }

       .boxadd {
        width: 400px;
       }
       
       h4 {
         Margin-bottom: 5px;  
       }
      </style>
</head>
<body>
<div><h2>Car market</h2></div>
<div style="%SECTION_SELECT%">
    <form method="POST">
      <table>
        <caption>Selection of parameters</caption>
        <tr>
          <th>Parameters</th>
          <th>Values</th>
        </tr>
        <tr>
          <td>Brand</td>
          <td><input type = "text" class = "box" name = "brand" value = %VAL_BRAND%></td>
        </tr>
        <tr>
          <td>Model</td>
          <td><input type = "text" class = "box" name = "model" value = %VAL_MODEL%></td>
          <td><samp class = "ErrorMsg">test1</samp></td>
        </tr>
        <tr>
          <td>Year</td>
          <td><input type="number" class = "box" name = "year" value = %VAL_YEAR% min = "0" max = "2019"></td>
          <td><samp class = "ErrorMsg">test2</samp></td>
        </tr>
        <tr>
          <td>Engine volume</td>
          <td><input type="number" class = "box" name = "volume" value = %VAL_VOLUME% min = "0" max = "200000"></td>
        </tr>
        <tr>
          <td>Max speed</td>
          <td><input type="number" class = "box" name = "speed" value = %VAL_SPEED% min = "100" max = "400"></td>
        </tr>
        <tr>
          <td>Color</td>
          <td><input type = "text" class = "box" name = "color" value = %VAL_COLOR%></td>
        </tr>
        <tr>
          <td>Price</td>
          <td><input type="number" class = "box" name = "price" value = %VAL_PRICE% min = "100" max = "400"></td>
        </tr>
      </table>
      <div style="%SECTION_CLIENTDATA%">
        <h3>Enter client details</h3>
        <h4>Name</h4>
        <input type = "text" class = "boxadd" name = "name" value = %VAL_NAME%> <samp class = "ErrorMsg">%ERROR_NAME%</samp><br>
        <h4>Surname</h4>
        <input type = "text" class = "boxadd" name = "surname" value = %VAL_SURNAME%> <samp class = "ErrorMsg">%ERROR_NAME%</samp><br>
        <h4>Payment method</h4>
        <select name = "paymentMethod" class = "box">
            %SELECT%
        </select>
      </div>
      <input type = "submit" Value = %VAL_BUTTON% ><br>
    </form>
</div>
<div style=%SECTION_LISTCARS%>
  <table border="1" width="50%">
    <caption>List of cars</caption>
    <tr>
      <th>ID</th>
      <th>Brand</th>
      <th>Model</th>
      <th>info</th>
    </tr>
    %VAL_LISTCAR%
  </table>
</div>

<div style="color: #FF0000; font-size: 15px;"><strong>%ERRORS%</strong></div>
</body>
</html>
