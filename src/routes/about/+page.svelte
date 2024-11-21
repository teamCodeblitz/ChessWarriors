<script lang="ts">
	import { onMount } from 'svelte';

	let words: HTMLSpanElement[] = [];

	onMount(() => {
		words = Array.from(document.querySelectorAll('.animate-word'));
		window.addEventListener('scroll', handleScroll);
		handleScroll(); // Initial call to set colors
		return () => window.removeEventListener('scroll', handleScroll);
	});

	function handleScroll() {
		const windowHeight = window.innerHeight;
		const centerY = windowHeight / 2;

		words.forEach((word) => {
			const rect = word.getBoundingClientRect();
			const wordCenterY = rect.top + rect.height / 2;
			const distanceFromCenter = Math.abs(centerY - wordCenterY);
			const maxDistance = windowHeight / 8;

			// Sharp transition
			const progress = distanceFromCenter < maxDistance ? 1 : 0;

			if (boldWords.includes(word.textContent?.trim() ?? '')) {
				// Orange for bold words
				const r = 50 + 185 * progress;
				const g = 50 + 39 * progress;
				const b = 50 + 7 * progress;
				word.style.color = `rgb(${r}, ${g}, ${b})`;
			} else {
				// White for other words
				const colorValue = 50 + 205 * progress;
				word.style.color = `rgb(${colorValue}, ${colorValue}, ${colorValue})`;
			}
		});
	}

	const boldWords = [
		'Michael',
		'D.',
		'Dayandante',
		'CSE317',
		'design,',
		'motion',
		'web',
		'development',
		'multiple'
	];

	function getWordStyle(word: string) {
		return boldWords.includes(word) ? 'color: rgb(50, 50, 50);' : 'color: rgb(50, 50, 50);';
	}
</script>

<section
	class="mx-[150px] mt-16 px-1 text-left" 
	style="font-family: 'Avant Garde', 'Century Gothic', 'AppleGothic', sans-serif;"
>
	<p class="text-[4.5rem] font-light leading-[1.1] tracking-tight">
		{#each "I'm Michael D. Dayandante a BSCS student level 3. At the crossroads of the design, motion and web development also the diversity of my skills allows me to approach design challenges from multiple perspectives. This is for the completion of a project on CSE317 subject.".split(' ') as word}
			<span
				class="animate-word"
				class:font-bold={boldWords.includes(word)}
				style={getWordStyle(word)}
			>
				{word}{' '}
			</span>
		{/each}
	</p>


	
</section>
