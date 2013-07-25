<?php
  Error_Reporting(E_ALL | E_STRICT);
  Ini_Set('display_errors', true);
  require_once 'lib/MinecraftQuery.php';
  require_once 'lib/functions.php';
  $Timer = MicroTime( true );
  $Query = new MinecraftQuery( );
  try { $Query->Connect('<server>', <port>); } catch(MinecraftQueryException $e) { $Error = $e->getMessage(); }
  $Skip = Array("HostIp", "HostPort", "Plugins", "RawPlugins", "Software");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php if( isset( $Error ) ): ?>
  <div id="error">
    <b>Exception:</b>
    <?php echo htmlspecialchars( $Error ); ?>
  </div>
<?php else: ?>
    <table>
      <thead>
        <tr>
          <th colspan="2">Server Info</th>
        </tr>
      </thead>
      <tbody>
<?php if( ( $Info = $Query->GetInfo( ) ) !== false ): ?>
<?php $index = 0; ?>
<?php foreach( $Info as $InfoKey => $InfoValue ): ?>
<?php if (in_array($InfoKey, $Skip)) { continue; } $index++; ?>
        <tr<?php if ($index % 2 == 1) { echo ' class="alt"'; } ?>>
          <th><?php echo htmlspecialchars($InfoKey); ?></th>
          <td><?php
  if(Is_Array($InfoValue)) {
    echo "<pre>"; print_r($InfoValue); echo "</pre>";
  } else {
    echo processColors($InfoValue);
  }
?></td>
        </tr>
<?php endforeach; ?>
<?php endif; ?>
      </tbody>
      <thead>
        <tr>
          <th colspan="2">Players</th>
        </tr>
      </thead>
      <tbody>
<?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
<?php foreach($Players as $key => $Player): ?>
        <tr<?php if ($key % 2 == 0) { echo ' class="alt"'; } ?>>
          <td colspan="2"><?php echo processColors($Player); ?></td>
        </tr>
<?php endforeach; ?>
<?php else: ?>
        <tr>
          <td>None</td>
        </tr>
<?php endif; ?>
      </tbody>
    </table>
<?php endif; ?>
</body>
</html>
