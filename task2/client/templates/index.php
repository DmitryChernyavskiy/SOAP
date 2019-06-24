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
        .linkButton { 
          background: none;
          border: none;
          color: #0066ff;
          text-decoration: underline;
          cursor: pointer; 
        }
        .header { 
          width: 100%;
          
        }
        .header > div { 
          display: table-cell;
          margin-top: 5px;
          margin-bottom: 5px;
          width: 80%;
          background-color: gainsboro; 
        }
       .menu {
         vertical-align: top;   
         text-align: end;
       }

       #filterbutton {
        margin-top: 5px;
       }

       h4 {
         Margin-bottom: 5px;  
       }

       p {
         Margin-bottom: 3px;  
       }
      </style>
</head>
<body>
<div class="header">
  <div ><h2>Car market</h2></div>
  <div class="menu">
    <form method="POST">
    <input type="submit" class="linkButton" name = "button" Value = "home"/>
    <input type="submit" class="linkButton" name = "button" Value = "order"/>
    </form>
  </div>
</div>
<div style="%SECTION_SELECT%">
    <form method="POST" style="margin-bottom: 5px;">
      <table>
        <caption>Selection of parameters</caption>
        <tr>
          <th>Parameters</th>
          <th>Values</th>
        </tr>
        <tr>
          <td>Id:</td>
          <td>%VAL_ID%</td>
        </tr>
        <tr>
          <td>Brand:</td>
          <td>%VAL_BRAND%</td>
        </tr>
        <tr>
          <td>Model:</td>
          <td>%VAL_MODEL%</td>
        </tr>
        <tr>
          <td>Year:</td>
          <td>%VAL_YEAR%</td>
        </tr>
        <tr>
          <td>Engine volume:</td>
          <td>%VAL_VOLUME%</td>
        </tr>
        <tr>
          <td>Max speed:</td>
          <td>%VAL_SPEED%</td>
        </tr>
        <tr>
          <td>Color:</td>
          <td>%VAL_COLOR%</td>
        </tr>
        <tr>
          <td>Price:</td>
          <td>%VAL_PRICE%</td>
        </tr>
      </table>
      <div style="%SECTION_CLIENTDATA%">
        
        <table>
          <caption>Enter client details</caption>
          <tr>
            <td>Name</td>
            <td><input type = "text" class = "boxadd" name = "name" value = %VAL_NAME%> <samp class = "ErrorMsg">%ERROR_NAME%</samp><br></td>
          </tr>
          <tr>
            <td>Surname</td>
            <td><input type = "text" class = "boxadd" name = "surname" value = %VAL_SURNAME%> <samp class = "ErrorMsg">%ERROR_NAME%</samp><br></td>
          </tr>
          <tr>
            <td>Payment method</td>
            <td>     
                %SELECT%
            </td>
          </tr>
        </table>

      </div>
      <input type = "submit" id ="filterbutton" name = "button" Value = %VAL_BUTTON% ><br>
    </form>
    <form method="POST" style="%SECTION_CLIENTDATA%">
        <input type = "submit" Value = Cancel ><br>
    </form>
</div>
<div style="%SECTION_LISTCARS%">
  <table border="1" width="50%">
    <caption>List of cars</caption>
    <tr>
      <th>ID</th>
      <th>Brand</th>
      <th>Model</th>
      <th>Color</th>
      <th>info</th>
    </tr>
    %VAL_LISTCAR%
  </table>
</div>
<div style="%SECTION_ORDERS%">
  <table border="1" width="50%">
    <caption>Order of cars</caption>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Surname</th>
      <th>Pay method</th>
    </tr>
    %VAL_ORDERS%
  </table>
</div>

<div style="color: #FF0000; font-size: 15px;"><strong>%ERRORS%</strong></div>
</body>
</html>
