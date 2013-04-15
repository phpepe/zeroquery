<nav>
	<ul>
		<?php foreach ($this->getSubmenu()->getItems() as $item ): ?>
		<li>
			<a href="<?php echo $item->getLink(); ?>" ><?php echo $item->getTitle(); ?></a>
		</li>
		<?php endforeach ; ?>
	</ul>
</nav>

<h2> Example of how to use subpages</h2>
<p>Subpages are basically pages inside pages.  
<p>You need to create folder under you page folder called 'pages'
<p>See this example 