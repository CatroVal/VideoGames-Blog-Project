<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

 <!--CONTENIDO PRINCIPAL-->
 <div id="principal">
   <h1>Todas las Entradas</h1>

   <?php
    $entradas = conseguirEntradas($db);
    if(!empty($entradas)):
        while($entrada = mysqli_fetch_assoc($entradas)):
   ?>

   <article class="entrada">
     <a href="entrada.php?id=<?=$entrada['id']?>">
     <h2><?=$entrada['titulo']?></h2>
     <span class="fecha-entrada"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
     <p>
       <?=substr($entrada['descripcion'], 0, 170)."..."?>
     </p>
     </a>
   </article>
   <?php
        endwhile;
    endif;
   ?>

</div><!--FIN PRINCIPAL-->

 <?php require_once'includes/footer.php'; ?>
