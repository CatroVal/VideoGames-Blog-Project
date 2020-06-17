<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

 <!--CONTENIDO PRINCIPAL-->
 <div id="principal">
   <h1>Últimas Entradas</h1>

   <?php
    $entradas = conseguirEntradas($db, true, null, null);
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

   <div id="ver-todas">
       <a href="entradas.php">Ver toda las entradas</a>
   </div>
</div><!--FIN PRINCIPAL-->

 <?php require_once'includes/footer.php'; ?>
