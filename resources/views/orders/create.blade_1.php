<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <style>
      *,*:before,*:after {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        font-family: Helvetica, Arial;
      }
      
      h1 {
        margin: 0 0 30px 0;
        text-align: center;
      }

      form {
        max-width: 800px;
        margin: 10px auto;
        padding: 10px 20px;
        background: #f4f7f8;
        border-radius: 8px;
      }

      input[type="text"],
      input[type="email"],
      input[type="tel"],
      textarea {
        border: none;
        font-size: 16px;
        margin: 0 0 20px 0;
        padding: 10px;
        width: 100%;
        background-color: #e8eeef;
        color: #8a97a0;
      }

      input[type="radio"],
      input[type="checkbox"] {
        margin: 0 8px 8px 0;
      }
      
      .required {
        color: red;
      }

      textarea {
        resize: none;
        height: 170px;
      }
      select {
        padding: 6px;
        height: 32px;
        border-radius: 2px;
      }

      input[type="submit"] {
        padding: 19px 39px 18px 39px;
        color: #FFF;
        background-color: #4bc970;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        font-style: normal;
        border-radius: 5px;
        width: 100%;
        border: 1px solid #3ac162;
        border-width: 1px 1px 3px;
        box-shadow: 0 -1px 0 rgba(255, 255, 255, 0.1) inset;
        margin-bottom: 10px;
      }
      
      input[type="submit"]:hover {
        background-color: #52b46f;
      }

      fieldset {
        margin-bottom: 10px;
        border: none;
      }

      legend {
        font-size: 1.4em;
        font-weight: bold;
        margin-bottom: 10px;
        color: #2ca02c;
      }

      label {
        display: block;
        margin: 0;
      }

      label.light {
        display: inline;
      }

      table {
        width: 100%;
      }

    </style>
  </head>
  <body>
    <h1>Zamówienie</h1>
    <form action="/order/store" method="POST">
      <input type="hidden" name="id">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <fieldset>
        <legend>Zamawiający</legend>
        <table>
          <tr>
            <td><input type="radio" name="private" id="no" value="false" checked="checked" onclick="document.getElementById('company').style='display: block'"><label for="no" class="light">Firma</label></td>
            <td width="1%"></td>
            <td><input type="radio" name="private" id="yes" value="true" onclick="document.getElementById('company').style='display: none'"><label for="yes" class="light">Osoba prywatna</label></td>
          </tr>
        </table>
        <div id="company">
          <label for="nip">NIP</label><input type="text" name="nip">
          <label for="name">Nazwa firmy</label><input type="text" name="name">
          <label for="address">Adres</label><input type="text" name="address">
          <table>
            <tr>
              <td width="30%"><label for="code">Kod pocztowy</label><input type="text" name="code"></td>
              <td width="1%"></td>
              <td><label for="city">Miejscowość</label><input type="text" name="city"></td>
            </tr>
          </table>
          <h4>Osoba kontaktowa</h4>
        </div>
        <table>
          <tr>
            <td><label for="firstname">Imię</label><input type="text" name="firstname"></td>
            <td width="1%"></td>
            <td><label for="lastname">Nazwisko</label><input type="text" name="lastname"></td>
          </tr>
        </table>
        <label for="tripfrom">Adres e-mail <a class="required">*</a></label><input type="email" name="mail" required="true">
        <label for="tripfrom">Telefon</label><input type="tel" name="phone">
      </fieldset>
      <fieldset>
        <legend>Trasa</legend>
        <table>
          <tr>
            <td><label for="tripfrom">Z <a class="required">*</a></label><input type="text" name="tripfrom" required="true"></td>
            <td width="1%"></td>
            <td><label for="tripto">Do <a class="required">*</a></label><input type="text" name="tripto" required="true"></td>
          </tr>
        </table>
        <label for="distance">Dystans <a class="required">*</a></label><input type="text" name="distance" required="true">
        <label for="tripinfo">Dodatkowe informacje</label><textarea name="tripinfo"></textarea>
      </fieldset>
      <fieldset>
        <legend>Data wyjazdu</legend>
        <table>
          <tr>
            <td><label for="datefrom">Od <a class="required">*</a></label><input type="text" name="datefrom" placeholder="dd-mm-yyyy" required="true"></td>
            <td width="1%"></td>
            <td><label for="dateto">Do <a class="required">*</a></label><input type="text" name="dateto" placeholder="dd-mm-yyyy" required="true"></td>
          </tr>
        </table>
      </fieldset>
      <fieldset>
        <legend>Szczegóły</legend>
        <textarea name="info"></textarea>
      </fieldset>
      <fieldset>
        <legend>Ilość osób</legend>
        <input type="text" name="count">
      </fieldset>
      <fieldset>
        <legend>Środek transportu</legend>
        <input type="text" name="vehicle">
      </fieldset>
      <fieldset>
        <legend>Cena</legend>
        <label for="price">Całkowita <a class="required">*</a></label><input type="text" name="price" required="true">
        <label for="vehicle">Szczegóły:</label><textarea name="priceinfo"></textarea>
      </fieldset>
      <fieldset>
        <legend>Zlecenie</legend>
        <table>
          <tr>
            <td><label for="requestdate">Data otrzymania</label><input type="text" name="requestdate" placeholder="dd-mm-yyyy" required="true"></fieldset></td>
            <td width="1%"></td>
            <td><label for="answerdate">Data odpowiedzi</label><input type="text" name="answerdate" placeholder="dd-mm-yyyy" required="true"></fieldset></td>
          </tr>
        </table>
      </fieldset>
      <input type="submit" name="save" value="Zapisz">
    </form>
  </body>
</html>
