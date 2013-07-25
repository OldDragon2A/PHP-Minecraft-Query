<?php
  Error_Reporting(E_ALL | E_STRICT);
  Ini_Set('display_errors', true);
  require_once 'lib/MinecraftQuery.php';
  $Timer = MicroTime( true );
  $Query = new MinecraftQuery( );
  try { $Query->Connect('<server>', '<port>'); } catch(MinecraftQueryException $e) { $Error = $e->getMessage(); }
  $Skip = Array("HostIp", "HostPort");
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
          <th colspan="2">Server info</th>
        </tr>
      </thead>
      <tbody>
<?php if( ( $Info = $Query->GetInfo( ) ) !== false ): ?>
<?php foreach( $Info as $InfoKey => $InfoValue ): ?>
<?php if (in_array($InfoKey, $Skip)) { continue; } ?>
        <tr>
          <td><?php echo htmlspecialchars( $InfoKey ); ?></td>
          <td><?php
  if(Is_Array($InfoValue)) {
    echo "<pre>";
    print_r($InfoValue);
    echo "</pre>";
  } else {
    echo htmlspecialchars($InfoValue);
  }
?></td>
        </tr>
<?php endforeach; ?>
<?php endif; ?>
      </tbody>
    </table>
    <table>
      <thead>
        <tr>
          <th>Players</th>
        </tr>
      </thead>
      <tbody>
<?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
<?php foreach($Players as $key => $Player): ?>
        <tr<?php if ($key % 2 == 0) { echo ' class="alt"'; } ?>>
          <td><?php echo htmlspecialchars( $Player ); ?></td>
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
