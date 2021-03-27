<?php

defined('CORE_ACP') or exit;

function redirectToEditPage()
{
    header('Location: acp.php?crk=modifrlz');
    exit;
}

if (!isset($_GET['id']) || !ctype_digit($_GET['id']))
{
    redirectToEditPage();
}

$id = intval($_GET['id']);

if ($id === 0)
{
    redirectToEditPage();
}

$release_query = $db_link->prepare('SELECT * FROM releases WHERE id = ?');

$release_query->execute([ $id ]);

if ($release_query->rowCount() !== 1)
{
    redirectToEditPage();
}

if (isset($_POST['releasename'], $_POST['url'], $_POST['cracker']))
{
    if (!empty($_POST['releasename']) AND !empty($_POST['url']) AND !empty($_POST['cracker']))
    {
        if (check_token('edit', 600, false))
        {
            $releasename = $_POST['releasename'];
            $url         = $_POST['url'];
            $cracker     = $_POST['cracker'];

            $query = $db_link->prepare('UPDATE releases SET name = ?, url = ?, cracker = ? WHERE id = ?;');

            $query->execute([
                $releasename,
                $url,
                $cracker,
                $id
            ]);

            echo('<font color="green">Release edited.</font>');
        }
        else
        {
            echo('<font color="red">Invalid Token!<br>Please try again.</font>');
        }
    }
}

$release_query->execute([ $id ]);

$release = $release_query->fetch(PDO::FETCH_OBJ);

?>
<h1>:: Edit &#1103;elease ::</h1>
<hr />
<form action="<?php echo($_SERVER['SCRIPT_NAME']); ?>?crk=editrlz&id=<?php echo($release->id); ?>" method="POST">
    <table cellpadding="4" cellspacing="0">
        <tr>
            <td><div align="right">Application name:</div></td>
            <td><input type="text" name="releasename" size="60" value="<?php display($release->name); ?>" /></td>
        </tr>
        <tr>
            <td><div align="right">Release link: </div></td>
            <td><input type="text" name="url" size="60" value="<?php display($release->url); ?>" /></td>
        </tr>
        <tr>
            <td><div align="right">Cracker : </div></td>
            <td><input type="text" name="cracker" value="<?php display($release->cracker); ?>" /></td>
        </tr>
        <tr>
            <td><div align="right"><input type="submit" value="Submit" /></div></td>
            <td></td>
        </tr>
    </table>
    <input type="hidden" name="token" value="<?php echo(generate_token('edit')); ?>"/>
</form>
