<script lang="ts">
	import '../app.css';
	import Dashboard from './dashboard/+page.svelte';
	import About from './about/+page.svelte';
	import Technologies from './technologies/+page.svelte';
	import Projects from './projects/+page.svelte';
	import MiniNav from './mininav/+page.svelte';
	import { onMount } from 'svelte';
	import { tweened } from 'svelte/motion';
	import { cubicOut } from 'svelte/easing';

	let scrollPosition = 0;
	let windowHeight = 0;
	let documentHeight = 0;
	let bgOpacity = tweened(0, {
		duration: 400,
		easing: cubicOut
	});

	let cursorX = 0;
	let cursorY = 0;
	let isHovering = false;
	let isOnDashboard = false;
	let currentSection = 'dashboard'; // Track the current section

	onMount(() => {
		const updateScroll = () => {
			scrollPosition = window.scrollY;
			windowHeight = window.innerHeight;
			documentHeight = document.documentElement.scrollHeight;

			// Calculate the position of the projects section
			const projectsSection = document.getElementById('projects');
			if (projectsSection) {
				const projectsTop = projectsSection.offsetTop;
				const projectsHeight = projectsSection.offsetHeight;
				const scrollPercentage = (scrollPosition - projectsTop + windowHeight) / projectsHeight;
				bgOpacity.set(Math.max(0, Math.min(1, scrollPercentage)));
			}

			// Check if the user is on the dashboard section
			const dashboardSection = document.getElementById('dashboard');
			if (dashboardSection) {
				const dashboardTop = dashboardSection.offsetTop;
				const dashboardHeight = dashboardSection.offsetHeight;
				if (scrollPosition >= dashboardTop && scrollPosition < dashboardTop + dashboardHeight) {
					currentSection = 'dashboard'; // Update current section
				} else {
					currentSection = ''; // Reset if not in dashboard
				}
			}
		};

		const updateCursorPosition = (e: MouseEvent) => {
			cursorX = e.clientX;
			cursorY = e.clientY;
		};

		const handleMouseEnter = () => {
			isHovering = true;
		};

		const handleMouseLeave = () => {
			isHovering = false;
		};

		window.addEventListener('scroll', updateScroll);
		window.addEventListener('resize', updateScroll);
		window.addEventListener('mousemove', updateCursorPosition);
		document.body.addEventListener('mouseenter', handleMouseEnter, true);
		document.body.addEventListener('mouseleave', handleMouseLeave, true);

		updateScroll();

		return () => {
			window.removeEventListener('scroll', updateScroll);
			window.removeEventListener('resize', updateScroll);
			window.removeEventListener('mousemove', updateCursorPosition);
			document.body.removeEventListener('mouseenter', handleMouseEnter, true);
			document.body.removeEventListener('mouseleave', handleMouseLeave, true);
		};
	});
</script>

<svelte:head>
	<!-- Remove the style block with font-face declarations -->
</svelte:head>

<main class="bg-gradient min-h-screen relative overflow-hidden custom-cursor">
	{#if currentSection !== 'dashboard'}
		<MiniNav />  <!-- Moved MiniNav to the top -->
	{/if}
	<div class="shapes" style="opacity: {1 - $bgOpacity}">
		<div class="shape shape-1"></div>
		<div class="shape shape-2"></div>
		<div class="shape shape-3"></div>
	</div>
	<div class="content">
		<section id="dashboard" class="min-h-screen w-full flex items-center justify-center">
			<Dashboard />
		</section>
		<section id="about" class="min-h-screen w-full flex items-center justify-center">
			<About />
		</section>
		<section id="technologies" class="min-h-screen w-full flex items-center justify-center">
			<Technologies />
		</section>
		<section id="projects" class="min-h-screen w-full flex items-center justify-center">
			<Projects />
		</section>
	</div>
	<!-- Render MiniNav at the bottom if on dashboard -->
	{#if isOnDashboard}
		<MiniNav />  <!-- Moved MiniNav to the bottom -->
	{/if}
	<div class="custom-scrollbar">
		<div 
			class="scrollbar-thumb"
			style="top: {(scrollPosition / (documentHeight - windowHeight)) * 100}%"
		></div>
	</div>
	
	<div class="bg-black absolute inset-0" style="opacity: {$bgOpacity};"></div>
	
	<!-- Add this div for the custom cursor -->
	<div class="cursor" class:hovering={isHovering} style="left: {cursorX}px; top: {cursorY}px;"></div>
</main>

