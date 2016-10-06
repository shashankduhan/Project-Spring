<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hello <?= $data['name'] ?></title>
    <link rel="stylesheet" href="/index/repo/master.css" type="text/css">
    <style type="text/css">
    #logout{padding:12px 12px; background:#eee; border-radius: 8px;display:inline-block;margin:4px;float:right;margin:25px;}

    </style>
  </head>
  <body align="center">
    <a href="\logout" id="logout">Logout</a>
    <p>
      Hello <?= $data[0]['name']; ?>
    </p>

    <table align="center">
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
        <td colspan="4">
          Fetching Accounts.....
        </td>
      </tr>
    </table>
  </body>
</html>
