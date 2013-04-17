<li class="<?php if (sizeof($this->children) && $this->page->getProps()->prop("submenu") == "true") { echo "sub-menu"; } ?>">
	<a class="wintrolink wanchorLink <?php if ($this->active) echo "active" ?>" href="<?php echo $this->link?>" target="<?php echo $this->target; ?>"><?php echo $this->title ?></a>
	
	<?php if (sizeof($this->children) && $this->page->getProps()->prop("submenu") == "true") { ?>
	
		<ul>
	
		<?php foreach ($this->children as $child) { ?>
			<li><a href="<?php echo $child->link?>" target="<?php echo $child->target; ?>"><?php echo $child->title; ?></a></li>
		<?php } ?>
	
		</ul>
	
	<?php } ?> 
	
</li>