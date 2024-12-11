<script lang="ts">
    import Header from '../../lib/header/+page.svelte';
    let warriorStyle = '';
    function updateWarriorStyle(event: Event) {
        warriorStyle = (event.target as HTMLInputElement).value;
        console.log(warriorStyle);
    }
</script>

<div class="h-screen flex flex-col">
    <Header />
    
    <div class="flex flex-grow">
        <div class="w-1/2 bg-black text-white p-6 shadow-lg">
            <div class="flex flex-col gap-6">
                <div class="bg-gray-900 text-white p-6 rounded-lg border border-yellow-500 h-auto md:h-[700px] flex flex-col">
                    <h3 class="text-2xl font-bold mb-4">Tulungang Lumakas!</h3>
                    <p class="text-xl mb-4">Hero, malapit na! Unti-unti nang nanunumbalik ang lakas nina Arthur at Gunner, pero kailangan pa ng kaunting tulong. Sa kanan, makikita mo silang dalawa, masiglang naghahanda para sa huling hakbang.</p>
                    <p class="text-xl mb-4">Gamitin ang justify property para maayos nilang maabot ang natitirang pagkain. Siguraduhin mong maipwesto ito nang tama upang tuluyan nang mapunan ang kanilang lakas. Napakahalaga ng huling hakbang na ito, Hero!</p>
                    <p class="text-xl mb-[30px]">Kapag nagawa mo ito, handa na sila para sa laban! Kaya natin ‘to! Gawin natin ang lahat para masiguro ang tagumpay nina Arthur at Gunner. Let’s go!</p>

                    <div class="bg-gray-300 h-[5px] -mb-[10px] mt-[10px]"></div>
                    <!-- Goal -->
                    <div class="flex items-center justify-start w-full mb-[20px] mt-[40px]">
                        <h2 class="text-sm font-bold -mr-[20px]">Your current mission:</h2>
                        <img src="./characters/warrior3d.gif" alt="Warrior" class="w-[100px] h-[100px] -mt-[10px] -mr-[15px]">
                        <span>=</span>
                        <img src="./characters/enemy1.gif" alt="Life" class="w-[150px] h-[150px] mt-[5px] ml-[10px]">
                        <img src="./characters/gunner.gif" alt="Gunner" class="w-[90px] h-[90px] -mt-[10px] -mr-[15px]">
                        <span>=</span>
                        <img src="./characters/enemy1.gif" alt="Life" class="w-[150px] h-[150px] ml-[10px]">
                    </div>
                    <!-- Answer -->
                    <div class="flex flex-col items-start bg-gray-800 p-4 rounded-lg shadow-lg">
                        <ol class="list-decimal ml-4 text-yellow-300">
                            <p class="text-gray-400">// Gamitin ang justify property para ilagay si Arthur at Gunner sa pagkain.</p>
                            <li></li>
                            <li><p style="margin-left: 15px;"><span class="text-gray-400">&lt;</span>div <span class="text-violet-500">class</span><span class="text-white">=</span><span class="text-white">"flex<input type="text" id="field" class="ml-3 h-2 rounded-lg border border-yellow-500 bg-gray-800 text-white text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your answer here..." on:input={updateWarriorStyle} /><span class="text-white">"</span><span class="text-gray-400">&gt;</span></p></li>
                            <li><p style="margin-left: 100px;">arthur-the-warrior-and-gunner-needs-food</p></li>
                            <li><p style="margin-left: 15px;"><span class="text-gray-400">&lt;</span>/div<span class="text-gray-400">&gt;</span></p></li>
                            <li></li>
                        </ol>
                    </div>
                </div>
                
                
                <button class="bg-purple-600 text-white p-2 rounded-lg mt-4" on:click={() => window.location.href='/tailwindcss-lvl4'}>Check Answer</button>
            </div>
        </div>
        <div class="w-1/2 text-white overflow-hidden bg-cover bg-center" style="background-image: url('./dungeon-map.jpg');">
            <div class="flex flex-col mt-[100px]">
                <div class="flex items-center">
                    <img src="./characters/warrior3d.gif" alt="Warrior" class="h-[200px] w-[200px] filter brightness-[150%]">
                    <img src="./characters/gunner.gif" alt="Gunner" class="h-[180px] w-[180px] mt-4">
                </div>
                <div class="flex mt-4">
                    <img src="./essentials/food.gif" alt="Life" class="h-[80px] w-[80px]">
                    <img src="./essentials/food2.gif" alt="Life" class="h-[80px] w-[80px]">
                </div>
            </div>
        </div>
    </div>
</div>