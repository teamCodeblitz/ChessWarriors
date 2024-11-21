<section class="flex flex-col items-center justify-center h-screen text-white" 
style="font-family: 'Avant Garde', 'Century Gothic', 'AppleGothic', sans-serif;"
>
  <div class="absolute top-10 left-20 p-4 text-lg ml-4"> <!-- Adjusted left to move the name right -->
    <p><strong style="font-size: 2rem;">MichaelD.</strong></p> <!-- Enlarged the name -->
  </div>
  <div class="flex flex-row items-start justify-start fade {isVisible ? '' : 'fade-out'}" style="margin-top: 150px;"> <!-- Increased margin-top to move the image down further -->
    <img src="profile.png" alt="Profile Picture" class="w-[1280px] h-[720]" aria-hidden="true" /> <!-- Updated to use custom width and height -->
  </div>
  <div class="absolute top-10 right-20 p-4 text-lg ml-4"> <!-- Adjusted top to lower the date and time -->
    <p>{currentDateTime}</p>
  </div>
</section>

<style>
  .fade {
    transition: opacity 0.1s ease; /* Fade transition */
  }
  .fade-out {
    opacity: 0; /* Fully transparent */
  }
</style>

<script lang="ts">
  import { onMount } from 'svelte';

  let currentDateTime: string = '';
  let isVisible: boolean = true; // State to control image visibility

  const updateTime = () => {
    const now = new Date();
    const options: Intl.DateTimeFormatOptions = {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false // Change to true for 12-hour format
    };
    currentDateTime = now.toLocaleString(undefined, options); // Format the date and time
  };

  const handleScroll = () => {
    isVisible = window.scrollY === 0; // Image is visible only at the top of the page
  };

  onMount(() => {
    updateTime();
    const interval = setInterval(updateTime, 1000);
    window.addEventListener('scroll', handleScroll); // Add scroll event listener
    return () => {
      clearInterval(interval); // Cleanup on component destroy
      window.removeEventListener('scroll', handleScroll); // Remove scroll event listener
    };
  });
</script>
