<script lang="ts">
	import { onMount } from 'svelte';
	import { faSignOutAlt, faStar, faTrophy } from '@fortawesome/free-solid-svg-icons';
	import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
	import Header from '$lib/header/+page.svelte';


	// Define the logout function
	function logout() {
		window.location.href = "/login";
		console.log("User logged out");
	}

	let userName = ""; // Default value
	let userLevel = ""; // Default value
	let userExp = ""; // Default value
	let userRank = ""; // Default value
	let userDiamonds = 0; // Change type to number
	let userId = ""; // Define userId variable
	let userStars = 0; // Set the number of active stars
	const totalStars = 5; // Total number of stars

	// Define a mapping for user ranks
	const rankMapping: { [key: number]: string } = {
		1: 'Grand-Master',
		2: 'Epic',
		3: 'Legend',
		4: 'Mythic',
		5: 'Mythical-Honor',
		6: 'Mythical-Glory',
	};

	// Fetch user information on component mount
	onMount(async () => {
		userId = localStorage.getItem('user-id')!; // Use non-null assertion
		if (userId) {
			const response = await fetch('http://localhost/codemaster/codemasters-backend/modules/get_user_info.php?user-id=' + userId, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({ 'user-id': userId })
			});
			const data = await response.json();
			if (data.message) {
				console.error(data.message);
			} else {
				userName = data['user-name']; // Assuming 'username' is a field in your database
				userLevel = data['user-level']; // Assuming 'level' is a field in your database
				userExp = data['user-exp']; // Assuming 'exp' is a field in your database
				userRank = rankMapping[data['user-rank']] || 'unknown'; // Map the numeric rank to its name
				userStars = data['rank-star']; // Ensure this is a number, default to 0 if conversion fails
				userDiamonds = data['user-diamonds']; // Convert to number
		
			}
		}
	});
</script>

<div class="h-screen bg-gradient-to-b from-gray-900 to-black">
    <div class="w-full flex justify-center">
        <Header />
    </div>
<div class="flex flex-col items-center justify-center h-screen bg-gradient-to-b from-black to-gray-900 mt-[-100px]">

	<!-- Content -->
    <h1 class="flaming-text">PUMILI NG ISTORYA</h1>
    <div class="flex space-x-6 mt-10">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-white transition-transform transform hover:scale-105 relative w-96 h-[600px] flex flex-col">
			<div class="flex items-center justify-center w-full h-2/3 rounded-lg overflow-hidden shadow-md">
				<img src="./warrior-head.jpg" alt="CSS" class="object-cover w-full h-full">
			</div>
			<p class="text-center text-3xl font-bold mt-4 text-yellow-400">TailwindCSS</p>
			<p class="text-center text-lg mt-2 text-white">Tulungan ang mandirigma na ito gamit ang CSS upang talunin ang masasamang kalaban!</p>
			<div class="flex-grow"></div>
			<button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition" on:click={() => window.location.href='/tailwindcss-lvl1'}>
				Play Now
			</button>
		</div>
        
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-white transition-transform transform hover:scale-105 relative w-96 h-[600px] flex flex-col">
			<div class="flex items-center justify-center w-full h-2/3 rounded-lg overflow-hidden shadow-md">
				<img src="./assasin-head.jpg" alt="JavaScript" class="object-cover w-full h-full">
			</div>
			<p class="text-center text-3xl font-bold text-yellow-400">HTML</p>
			<p class="text-center text-lg mt-2 text-white">Sumali sa assassin na ito sa mga stealth mission gamit ang HTML!</p>
			<div class="absolute inset-0 bg-gray-800 opacity-80 flex flex-col items-center justify-center transition-opacity duration-300 hover:opacity-95 p-4">
				<img src="./ranks/Legend.png" alt="Legend" class="w-[100px] h-[100px] mb-2 glow-effect">
				<span class="text-white text-xl font-bold text-center">Maabot ang antas na Legend upang i-unlock ang antas na ito</span>
			</div>
			<div class="flex-grow"></div>
			<button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition">
				Play Now
			</button>
		</div>	
		<div class="bg-gray-800 p-8 rounded-lg shadow-lg text-white transition-transform transform hover:scale-105 relative w-96 h-[600px] flex flex-col">
			<div class="flex items-center justify-center w-full h-2/3 rounded-lg overflow-hidden shadow-md">
				<img src="./wizard-head.jpg" alt="HTML" class="object-cover w-full h-full">
			</div>
			<p class="text-center text-3xl font-bold mt-4 text-yellow-400">Python</p>
			<p class="text-center text-lg mt-2 text-white">Tulungan ang wizard na ito sa pagbato ng mga spell gamit ang Python!</p>
			<div class="absolute inset-0 bg-gray-800 opacity-80 flex flex-col items-center justify-center transition-opacity duration-300 hover:opacity-95 p-4">
				<img src="./ranks/Mythical-Glory.png" alt="Mythical-Glory" class="w-[100px] h-[100px] mb-2 glow-effect">
				<span class="text-white text-xl font-bold text-center">Maabot ang antas na Mythical Glory upang i-unlock ang antas na ito</span>
			</div>
			<div class="flex-grow"></div>
			<button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition">
				Play Now
			</button>
		</div>
    </div>
</div>
</div>

<style>
    .glow-effect {
        animation: glow 1.5s infinite alternate;
		opacity: 0.8;
    }

    @keyframes glow {
        0% {
            filter: drop-shadow(0 0 8px rgba(255, 215, 0, 0.6));
        }
        100% {
            filter: drop-shadow(0 0 12px rgba(255, 215, 0, 1));
        }
    }

    .flaming-text {
        color: #ffffff; /* Base color for the flame */
        text-shadow: 
            0 0 5px rgba(255, 69, 0, 0.8), 
            0 0 10px rgba(255, 140, 0, 0.8), 
            0 0 15px rgba(255, 215, 0, 0.8);
        animation: flame 1.5s infinite alternate;
    }

    @keyframes flame {
        0% {
            text-shadow: 
                0 0 5px rgba(255, 69, 0, 0.8), 
                0 0 10px rgba(255, 140, 0, 0.8), 
                0 0 15px rgba(255, 215, 0, 0.8);
        }
        100% {
            text-shadow: 
                0 0 10px rgba(255, 69, 0, 1), 
                0 0 20px rgba(255, 140, 0, 1), 
                0 0 30px rgba(255, 215, 0, 1);
        }
    }
</style>