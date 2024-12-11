<script lang="ts">
    import Header from '../../lib/header/+page.svelte';
    import { faStar, faGem, faChartLine } from '@fortawesome/free-solid-svg-icons';
    import { FontAwesomeIcon } from '@fortawesome/svelte-fontawesome';
    import { onMount } from 'svelte';
    let warriorStyle = '';
    let levelNo = 1;
    let userAnswer = '';
    let showPopup = false;
    let popupMessage = '';
    let userId: string | null = '';

    onMount(() => {
        userId = localStorage.getItem('user-id');
        console.log('Current User ID:', userId);
    });

    function updateWarriorStyle(event: Event) {
        warriorStyle = (event.target as HTMLInputElement).value;
        userAnswer = warriorStyle;
        console.log(warriorStyle);
    }

    async function fetchAnswer(levelNo: number) {
        try {
            const response = await fetch(`http://localhost/codemaster/codemasters-backend/modules/tailwind-answers.php?level_no=${levelNo}`);
            const data = await response.json();
            console.log(data);
            localStorage.setItem(`level_${levelNo}_answer`, JSON.stringify(data.level_answer));
            console.log(`Stored answer for level ${levelNo}:`, data.level_answer);
            console.log(localStorage.getItem(`level_${levelNo}_answer`));
        } catch (error) {
        }
    }

    fetchAnswer(1);

    function checkAnswer() {
        const storedAnswer = localStorage.getItem(`level_${levelNo}_answer`);
        if (storedAnswer) {
            const parsedAnswer = JSON.parse(storedAnswer);
            if (parsedAnswer === warriorStyle) {
                popupMessage = "Correct answer!";
                showPopup = true;

                // Update user data
                updateUserData(userId, 'add');
            } else {
                popupMessage = "Incorrect answer. Try again!";
                showPopup = true;
                // Deduct star for incorrect answer
                updateUserData(userId, 'deduct');
            }
        } else {
            popupMessage = "No answer stored for this level.";
            showPopup = true;
        }
    }

    async function updateUserData(userId: string | null, action: 'add' | 'deduct') {
        if (!userId) {
            console.error('User ID is null or empty. Cannot update user data.');
            return; // Exit the function if userId is invalid
        }

        try {
            const response = await fetch(`http://localhost/codemaster/codemasters-backend/modules/update_user.php?user-id=${userId}&action=${action}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Access-Control-Allow-Origin': '*'
                },
                mode: 'cors'
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            if (result.success) {
                console.log('User data updated successfully');
            } else {
                console.error('Failed to update user data:', result.error);
            }
        } catch (error) {
            console.error('Error updating user data:', error);
        }
    }

    function closePopup() {
        showPopup = false;
        // Check if the popup message is "Try Again" to reload the page
        if (popupMessage === "Incorrect answer. Try again!") {
            // Deduct star for incorrect answer
            updateUserData(userId, 'deduct');
            window.location.reload(); // Reload the page
        } else {
            // Redirect to the next level
            window.location.href = '/tailwindcss-lvl2';
        }
    }
</script>

<!-- Popup Modal -->
{#if showPopup}
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-8 rounded-lg shadow-2xl max-w-sm w-full">
            <img src="./mini-logo.png" alt="Fallback description if image fails to load" class="max-w-[150px] h-auto mx-auto -mt-10" aria-hidden="true" />
            <h2 class="text-lg font-bold text-center mt-4 text-white">{popupMessage}</h2>
            <!-- Only show rewards if the answer is correct -->
            {#if popupMessage === "Correct answer!"}
                <div class="flex justify-center items-center mt-4 space-x-4">
                    <div class="flex items-center">
                        <FontAwesomeIcon icon={faStar} class="text-white mr-1" />
                        <span class="text-white text-lg">+1 Star</span>
                    </div>
                    <div class="flex items-center">
                        <FontAwesomeIcon icon={faGem} class="text-white mr-1" />
                        <span class="text-white text-lg">+100 Diamonds</span>
                    </div>
                    <div class="flex items-center">
                        <FontAwesomeIcon icon={faChartLine} class="text-white mr-1" />
                        <span class="text-white text-lg">+30% EXP</span>
                    </div>
                </div>
            {/if}
            <button class="mt-6 bg-yellow-500 text-white p-3 rounded-lg hover:bg-yellow-600 transition duration-200 w-full" on:click={closePopup}>
                {popupMessage === "Incorrect answer. Try again!" ? "Try Again" : "Next Level"}
            </button>
        </div>
    </div>
{/if}

<div class="h-screen flex flex-col">
    <Header />
    
    <div class="flex flex-col md:flex-row flex-grow">
        <div class="w-full md:w-1/2 bg-black text-white p-6 shadow-lg">
            <div class="flex flex-col gap-6">
                <div class="bg-gray-900 text-white p-6 rounded-lg border border-yellow-500 h-auto md:h-[700px] flex flex-col">
                    <h3 class="text-2xl font-bold mb-4">Kailangan ng Buhay!</h3>
                    <p class="text-xl mb-4">Hello, Hero! Tulungan natin si Arthur para talunin ang tatlong masasamang magkakapatid at maibalik ang ninakaw na ginto! Ready ka na ba sa adventure?</p>
                    <p class="text-xl mb-4">Mukhang nabawasan ng health si Arthur matapos siyang magsanay. Tulungan natin siya! Sa kanan, makikita mo si Arthur. Sa taas naman, makikita mo ang health bar niya. Ang goal mo ay ma-restore ang health niya. Madali lang ba? Great! Simulan na natin!</p>
                    <p class="text-xl mb-[30px]">Gamitin ang justify-content property para makuha ni Arthur ang health bar . Baka makatulong ito para ma-restore ang health niya.</p>

                    <div class="bg-gray-300 h-[5px] -mb-[10px]"></div>
                    <!-- Goal -->
                        <div class="flex items-center justify-start w-full mb-[20px] mt-[40px]">
                            <h2 class="text-sm font-bold -mr-[20px]">Your current mission:</h2>
                            <img src="./characters/warrior3d.gif" alt="Warrior" class="w-[100px] h-[100px] -mt-[10px] -mr-[15px]">
                            <span>=</span>
                            <img src="./essentials/lifehealth.gif" alt="Life" class="w-[60px] h-[50px] mt-[5px]">
                        </div>
                    <!-- Answer -->
                    <div class="flex flex-col items-start bg-gray-800 p-4 rounded-lg shadow-lg">
                        <ol class="list-decimal ml-4 text-yellow-300">
                            <p class="text-gray-400">// Gamitin ang justify property para ilagay si Arthur sa orb.</p>
                            <li></li>
                            <li><p style="margin-left: 15px;"><span class="text-gray-400">&lt;</span>div <span class="text-violet-500">class</span><span class="text-white">=</span><span class="text-white">"flex<input type="text" id="field" class="ml-3 h-2 rounded-lg border border-yellow-500 bg-gray-800 text-white text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your answer here..." on:input={updateWarriorStyle} /><span class="text-white">"</span><span class="text-gray-400">&gt;</span></p></li>
                            <li><p style="margin-left: 100px;">arthur-the-warrior-needs-health</p></li>
                            <li><p style="margin-left: 15px;"><span class="text-gray-400">&lt;</span>/div<span class="text-gray-400">&gt;</span></p></li>
                            <li></li>
                        </ol>
                    </div>
                </div>
                
                <button class="bg-purple-600 text-white p-2 rounded-lg mt-4" on:click={checkAnswer}>Check Answer</button>
            </div>
        </div>
        
        <div class="w-full md:w-1/2 text-white overflow-hidden bg-cover bg-center rounded-lg" style="background-image: url('./dungeon-map.jpg');">
            <div class="flex justify-center items-center">
                <img src="./essentials/lifehealth.gif" alt="Life" class="absolute h-[100px] w-[130px] mt-[250px] filter brightness-[80%]">
            </div>
            <div class={`flex ${warriorStyle}`}>
                <img src="./characters/swordman.gif" alt="Warrior" class="h-[200px] w-[200px] absolute mt-[30px] filter">
            </div>
        </div>
    </div>
</div>