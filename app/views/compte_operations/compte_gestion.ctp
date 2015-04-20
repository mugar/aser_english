<div id='view'>
<div class="document">
<h3>TABLEAU DES SOLDES DE GESTION</h3>
<br />
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')</h4>';
		}
?>
<br />	
<br />	
<br />	
<table cellpadding="0" cellspacing="0" id="recherche" class="border" >
	
	<tr class="border" style="font-weight:bold; font-size:15px;">
			<th colspan="3">CHARGES</th>
			<th colspan="3">PRODUITS</th>
	</tr>
	<tr class="border">
			<th>N° DU COMPTE</th>
			<th>LIBELLE</th>
			<th>MONTANT</th>
			<th>N° DU COMPTE</th>
			<th>LIBELLE</th>
			<th>MONTANT</th>
	</tr>
	
		<tr >
			<td>60</td>
			<td><?php echo  $charges[60]['name']; ?></td>
			<td><?php echo  $number->format(abs($charges[60]['solde']),$formatting); ?></td>
			<td>70</td>
			<td><?php echo  $produits[70]['name']; ?></td>
			<td><?php echo  $number->format(abs($produits[70]['solde']),$formatting); ?></td>
		</tr>
		<tr style="font-weight:bold; font-size:15px;">
			<td></td>
			<td></td>
			<td></td>
			<td>80</td>
			<td><?php echo  $resultat[80]['name']; ?></td>
			<td><?php echo  $number->format(abs($resultat[80]['solde']),$formatting); ?></td>
		</tr>
		<tr >
			<td>61</td>
			<td><?php echo  $charges[61]['name']; ?></td>
			<td><?php echo  $number->format(abs($charges[61]['solde']),$formatting); ?></td>
			<td>77</td>
			<td><?php echo  $produits[77]['name']; ?></td>
			<td><?php echo  $number->format(abs($produits[77]['solde']),$formatting); ?></td>
		</tr>
		<tr >
			<td>62</td>
			<td><?php echo  $charges[62]['name']; ?></td>
			<td><?php echo  $number->format(abs($charges[62]['solde']),$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr >
			<td>63</td>
			<td><?php echo  $charges[63]['name']; ?></td>
			<td><?php echo  $number->format(abs($charges[63]['solde']),$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr style="font-weight:bold; font-size:15px;">
			<td></td>
			<td></td>
			<td></td>
			<td>81</td>
			<td><?php echo  $resultat[81]['name']; ?></td>
			<td><?php echo  $number->format(abs($resultat[81]['solde']),$formatting); ?></td>
		</tr>
		<tr >
			<td>64</td>
			<td><?php echo  $charges[64]['name']; ?></td>
			<td><?php echo  $number->format(abs($charges[64]['solde']),$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr >
			<td>65</td>
			<td><?php echo  $charges[65]['name']; ?></td>
			<td><?php echo  $number->format(abs($charges[65]['solde']),$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr >
			<td>66</td>
			<td><?php echo  $charges[66]['name']; ?></td>
			<td><?php echo  $number->format(abs($charges[66]['solde']),$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr >
			<td>67</td>
			<td><?php echo  $charges[67]['name']; ?></td>
			<td><?php echo  $number->format(abs($charges[67]['solde']),$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>	
		<tr >
			<td>68</td>
			<td><?php echo  $charges[68]['name']; ?></td>
			<td><?php echo  $number->format(abs($charges[68]['solde']),$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr style="font-weight:bold; font-size:15px;">
			<td></td>
			<td></td>
			<td></td>
			<td>82</td>
			<td><?php echo  $resultat[82]['name']; ?></td>
			<td><?php echo  $number->format(abs($resultat[82]['solde']),$formatting); ?></td>
		</tr>
		<tr style="font-weight:bold; font-size:15px;">
			<td></td>
			<td>IMPOT/RESULTAT  (35%R.E )</td>
			<td><?php echo  $number->format(abs($impot),$formatting); ?></td>
			<td></td>
			<td></td>
			<td><?php echo  $number->format(abs($resultat[83]['solde']),$formatting); ?></td>
		</tr>	
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des charges', true), __('CompteOperation', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('CompteOperation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début'));									
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>