<!-- src/routes/technologies/+page.svelte -->
<style>
    .moving {
        animation: move 60s linear infinite;
        display: flex; /* Ensure cards are in a row */
        width: calc(700px * 5); /* Adjust based on the number of cards */
        gap: 16px; /* Add gap between cards */
    }

    .moving:hover {
        animation-play-state: paused; /* Pause animation on hover */
    }

    @keyframes move {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%); /* Adjust based on the number of cards */
        }
    }

    .card {
        min-width: 600px; /* Ensure cards have a fixed width */
        padding: 16px; /* Add padding to create a gap between images and cards */
    }

    .card:hover {
        animation: wave 0.5s ease-in-out; /* Add wavy effect on hover */
    }

    @keyframes wave {
        0% { transform: translateY(0); }
        25% { transform: translateY(-5px); }
        50% { transform: translateY(0); }
        75% { transform: translateY(5px); }
        100% { transform: translateY(0); }
    }
</style>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<section>
<div class="flex justify-center mb-4 mt-4 mx-2 overflow-x-auto"> <!-- Added overflow-x-auto to allow horizontal scrolling -->
    <div class="card bg-gray-800 bg-opacity-30 backdrop-blur-md shadow-md rounded-[20px] w-[15px] h-[400px] border-[0.5px] m-1"> <!-- Card 1 -->
        <div class="text-center"> <!-- Centering the icon and text -->
            <i class="fas fa-code text-white text-8xl -mt-[-50px]"></i> <!-- Changed icon for Skills -->
            <h2 class="text-white text-2xl">Skills</h2> <!-- Enlarged text for Card 1 -->
            <p class="text-white mt-2">I specialize in web development using HTML5, Angular, Svelte, CSS3, TailwindCSS, JavaScript, and TypeScript for building responsive and dynamic websites. I also leverage PHP and Node.js for backend functionality, along with Electron for desktop applications, ensuring seamless user experiences across platforms.</p> <!-- Added description for Card 1 -->
        </div>
    </div>
    <div class="card bg-gray-800 bg-opacity-30 backdrop-blur-md shadow-md rounded-[20px] w-[15px] h-[400px] border-[0.5px] m-1"> <!-- Card 2 -->
        <div class="text-center"> <!-- Centering the icon and text -->
            <i class="fas fa-users text-white text-8xl -mt-[-50px]"></i> <!-- Changed icon for Others -->
            <h2 class="text-white text-2xl">Others</h2> <!-- Enlarged text for Card 1 -->
            <p class="text-white mt-2">I utilize Bootstrap, MySQL, Material UI, Flowbite, and Matcomponents to create visually appealing and highly functional websites. By combining responsive design with powerful backend capabilities, I ensure a seamless user experience, while maintaining a modern aesthetic and efficient data management for web applications.</p> <!-- Added description for Card 1 -->
        </div>
    </div>
    <div class="card bg-gray-800 bg-opacity-30 backdrop-blur-md shadow-md rounded-[20px] w-[15px] h-[400px] border-[0.5px] m-1"> <!-- Card 3 -->
        <div class="text-center"> <!-- Centering the icon and text -->
            <i class="fas fa-laptop-code text-white text-8xl -mt-[-50px]"></i> <!-- Added negative margin-top to move the icon down -->
            <h2 class="text-white text-2xl">Tools</h2> <!-- Enlarged text for Card 1 -->
            <p class="text-white mt-2">I leverage Photoshop for graphic design, Figma for UI/UX prototyping, and Visual Studio Code as my primary code editor. I manage version control with Git and Git Bash, while using Prettier for code formatting and Error Lens to enhance my development workflow, ensuring clean and efficient coding practices.</p> <!-- Added description for Card 1 -->
        </div>
    </div>
</div>

<div class="flex flex-col space-y-4 h-screen justify-end">
    <div class="moving"> <!-- Removed 'mt-auto' to allow continuous movement -->
        <div class="card bg-gray-800 bg-opacity-30 backdrop-blur-md shadow-md rounded-[20px] h-[400px] border-[0.5px]">
            <img src="weatherapp.jpg" alt="Weather App" class="w-full h-full object-cover rounded-[20px]" />
        </div>
        <div class="card bg-gray-800 bg-opacity-30 backdrop-blur-md shadow-md rounded-[20px] h-[400px] border-[0.5px]">
            <img src="kanbanboard.png" alt="Weather App" class="w-full h-full object-cover rounded-[20px]" />
        </div>
        <div class="card bg-gray-800 bg-opacity-30 backdrop-blur-md shadow-md rounded-[20px] h-[400px] border-[0.5px]">
            <img src="weatherapp.jpg" alt="Weather App" class="w-full h-full object-cover rounded-[20px]" />
        </div>
        <div class="card bg-gray-800 bg-opacity-30 backdrop-blur-md shadow-md rounded-[20px] h-[400px] border-[0.5px]"> <!-- Duplicate for infinite effect -->
            <img src="weatherapp.jpg" alt="Weather App" class="w-full h-full object-cover rounded-[20px]" />
        </div>
        <div class="card bg-gray-800 bg-opacity-30 backdrop-blur-md shadow-md rounded-[20px] h-[400px] border-[0.5px]"> <!-- Duplicate for infinite effect -->
            <img src="weatherapp.jpg" alt="Weather App" class="w-full h-full object-cover rounded-[20px]" />
        </div>
    </div>
</div>


</section>