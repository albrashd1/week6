<?php
/* Smarty version 4.3.4, created on 2023-10-23 04:51:18
  from 'C:\xampp\htdocs\html\week6\templates\news.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6535dfa6cd57e0_49202497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7253a049260558a9fb88f237cea827e69415e392' => 
    array (
      0 => 'C:\\xampp\\htdocs\\html\\week6\\templates\\news.tpl',
      1 => 1698029477,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6535dfa6cd57e0_49202497 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '16251381956535dfa6cb7400_06270167';
?>
<!DOCTYPE html>
<html>
<head>
    <title>News Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php echo '<script'; ?>
>
        function submitForm() {
            document.getElementById("itemsPerPageForm").submit();
        }
    <?php echo '</script'; ?>
>
</head>
<body>
    <h1>News Articles</h1>
    
    <!-- Display the number of items per page selection -->
    <form id="itemsPerPageForm" action="index.php" method="get">
        Show:
        <select name="itemsPerPage" onchange="submitForm()">
            <option value="5" <?php if ($_smarty_tpl->tpl_vars['itemsPerPage']->value == 5) {?>selected<?php }?>>5</option>
            <option value="10" <?php if ($_smarty_tpl->tpl_vars['itemsPerPage']->value == 10) {?>selected<?php }?>>10</option>
            <option value="25" <?php if ($_smarty_tpl->tpl_vars['itemsPerPage']->value == 25) {?>selected<?php }?>>25</option>
            <option value="50" <?php if ($_smarty_tpl->tpl_vars['itemsPerPage']->value == 50) {?>selected<?php }?>>50</option>
            <option value="100" <?php if ($_smarty_tpl->tpl_vars['itemsPerPage']->value == 100) {?>selected<?php }?>>100</option>
            <option value="all" <?php if ($_smarty_tpl->tpl_vars['itemsPerPage']->value == 'all') {?>selected<?php }?>>All</option>
        </select>
    </form>

    <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['newsItems']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
            <li>
                <h2><a href="static_pages/<?php echo $_smarty_tpl->tpl_vars['row']->value['filename'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a></h2>
                <p><?php echo $_smarty_tpl->tpl_vars['row']->value['truncatedContent'];?>
</p>
                <p><em>Published on: <?php echo $_smarty_tpl->tpl_vars['row']->value['publish_date'];?>
</em></p>
            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>

    <div class="pagination">
        <a href='?page=<?php echo $_smarty_tpl->tpl_vars['prevPage']->value;?>
&itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['itemsPerPage']->value;?>
' class="<?php echo $_smarty_tpl->tpl_vars['prevDisabled']->value;?>
">Previous</a>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pageNumbers']->value, 'pageNumber');
$_smarty_tpl->tpl_vars['pageNumber']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pageNumber']->value) {
$_smarty_tpl->tpl_vars['pageNumber']->do_else = false;
?>
            <a href='?page=<?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
&itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['itemsPerPage']->value;?>
' <?php if ($_smarty_tpl->tpl_vars['pageNumber']->value == $_smarty_tpl->tpl_vars['currentpage']->value) {?>class='current'<?php }?>><?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
</a>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <a href='?page=<?php echo $_smarty_tpl->tpl_vars['nextPage']->value;?>
&itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['itemsPerPage']->value;?>
' class="<?php echo $_smarty_tpl->tpl_vars['nextDisabled']->value;?>
">Next</a>
    </div>
</body>
</html>
<?php }
}
