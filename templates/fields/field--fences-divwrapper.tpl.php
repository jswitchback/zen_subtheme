<?php
/**
 * @file field--fences-divwrapper.tpl.php
 * Wrap each field value & label in a <div> element.
 *
 * @see http://developers.whatwg.org/grouping-content.html#the-div-element
 */
?>
<div class="<?php print $classes; ?>">
<?php if ($element['#label_display'] == 'inline'): ?>
  <span class="field-label"<?php print $title_attributes; ?>>
    <?php print $label; ?>:
  </span>
<?php elseif ($element['#label_display'] == 'above'): ?>
  <h3 class="field-label"<?php print $title_attributes; ?>>
    <?php print $label; ?>
  </h3>
<?php endif; ?>

<?php if ($element['#label_display'] == 'inline'): ?>
	<?php foreach ($items as $delta => $item): ?>
	  <span class="item"<?php print $attributes; ?>>
	    <?php print render($item); ?>
	  </span>
	<?php endforeach; ?>
<?php else: ?>
	<?php foreach ($items as $delta => $item): ?>
	  <div class="item"<?php print $attributes; ?>>
	    <?php print render($item); ?>
	  </div>
	<?php endforeach; ?>
<?php endif; ?>
</div>