<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hello <?= $data['name'] ?></title>
  </head>
  <body>
    <p>
      Hello <?= $data[0]['name']; ?>
    </p>
    <a href="\logout">Logout</a>
    <table>
      <tr>
        <th>
          Account ID
        </th><th>
          Type
        </th><th>
          Balance
        </th><th>
          Status
        </th>
      </tr>
      <tr id="account_table_indicator">
        <td>
          Fetching Accounts.....
        </td>
      </tr>
    </table>
  </body>
</html>
