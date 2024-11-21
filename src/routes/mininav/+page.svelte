

<script lang="ts">
	import Icon from '@iconify/svelte';

	const navItems = [
		{ name: 'Home', icon: 'mdi:home' },
		{ name: 'About', icon: 'mdi:information' },
		{ name: 'Tech', icon: 'mdi:code-tags' }, // Change href for this item
		{ name: 'Projects', icon: 'mdi:folder' }
	];
</script>

<nav class="mini-nav">
	{#each navItems as item}
		<a href="#{item.name === 'Home' ? 'dashboard' : item.name === 'Tech' ? 'technologies' : item.name.toLowerCase()}" class="mini-nav-item" aria-label={item.name}>
			<Icon icon={item.icon} class="mini-nav-icon" />
		</a>
	{/each}
</nav>
