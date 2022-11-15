<?php
/* Smarty version 4.2.1, created on 2022-11-04 16:58:20
  from 'C:\xampp\htdocs\codigos\trabajo final parte 2\templates\inicio.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6365369c81f2b2_90418226',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '29382e5e0ad9df7abc301807cd498e555a56183d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\codigos\\trabajo final parte 2\\templates\\inicio.tpl',
      1 => 1665954872,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_6365369c81f2b2_90418226 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php if (!(isset($_SESSION['IS_LOGGED']))) {?>
    <h4 class="titulo">En esta pagina vas a poder ver todos los vehiculos publicados con sus especificaciones.
    Si quiere que tu vehiculo forme parte de la pagina contactenos. </h4>
<?php }?>
<div class="fiat">
    <img  class="fiat-logo" src="img/Fiat-Logo.png">
</div>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
