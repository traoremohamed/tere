<table width="100%" border="0" cellspacing="0" cellpadding="0" class="encadre"  align="center">
    <tbody>
    <tr>
        <td class="droite" width="20%"><img alt="Logo" src="/backend/assets/media/logos/logo-2.png"/></td>
        <td width="67%" class="droite" align="center"><h2 >Statistiques des produits <br />

            </h2>


            <?php  //cho $date1; ?></td>
        <td width="13%"><div align="right" ><?php echo date('d/m/Y'); ?> <br />
                <input type="button" name="Submit" value="Imprimer" class="ecran visuel_bouton" onclick="window.print();" />
            </div></td>
    </tr>
    </tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td height="32">&nbsp;</td>
    </tr>
</table>
<table border="0" width="100%" class="table table-striped table-bordered dTableR encadre" cellspacing="0"
       cellpadding="4">
    <tr center  bgcolor="#EEEEEE">
        <th>No</th>
        <th>Categorie produit</th>
        <th>Nom du produit</th>
        <th>Nombre de click</th>
    </tr>

    <?php
    $i = 0;
    foreach ($recherches as $recherche):
        $i++;
        ?>

        <tr >
            <td>{{ $i}}</td>
            <td>{{ $recherche->libelle_cat_prod}}</td>
            <td>{{ $recherche->titre_produit }}</td>
            <td>{{ $recherche->nombre}}</td>
        </tr>

    <?php endforeach; ?>



</table>

