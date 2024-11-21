<section class="w-full h-screen p-8 flex items-center">
  <div class="flex justify-between w-full"> <!-- Added flex and justify-between to the parent div -->
    <div>
      <div class="space-y-4"> <!-- Increased space between items -->
        {#each ['FLOWERAPP', 'GCEDUC', 'GCAMS', 'KANBAN BOARD', 'WEATHER APP'] as text, index}
          <div class="flex flex-col items-start group w-full relative"> <!-- Added relative positioning -->
            <h2 class="text-9xl font-bold transition-colors duration-300 
                       {index === 0 ? 'text-neutral-200 group-hover:text-orange-500' : 'text-neutral-200 group-hover:text-orange-500'}">
              {text}
            </h2>
            <p class="text-lg text-neutral-500 ml-0"> <!-- Removed margin-left for better alignment -->
              {#if index === 0}
                Our online flower shop is built using basic HTML and PHP, allowing users to browse, order, and manage floral products.
              {:else if index === 1}
                GCEDUC is an educational platform designed to facilitate online learning and resource sharing among students and educators.
              {:else if index === 2}
                GCAMS is a project management tool that helps teams collaborate effectively and track their progress on various tasks.
              {:else if index === 3}
                The Kanban Board application allows users to visualize their workflow and manage tasks efficiently using a drag-and-drop interface.
              {:else if index === 4}
                The Weather App provides real-time weather updates and forecasts, helping users plan their activities accordingly.
              {/if}
            </p>
            {#if index === 4} <!-- Conditional rendering for the pop-up image -->
              <img src="weatherapp.jpg" alt="Weather App" class="absolute right-[-500px] top-1/2 transform -translate-y-1/2 w-80 h-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300" /> <!-- Adjusted position and size -->
            {/if}
            {#if index === 3} <!-- Conditional rendering for the Kanban Board pop-up image -->
              <img src="kanbanboard.png" alt="Kanban Board" class="absolute right-[-500px] top-1/2 transform -translate-y-1/2 w-80 h-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300" /> <!-- Adjusted position and size -->
            {/if}
            {#if index === 0} <!-- Conditional rendering for the Flower Shop pop-up image -->
              <img src="flowershop.png" alt="Flower Shop" class="absolute right-[-500px] top-1/2 transform -translate-y-1/2 w-80 h-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300" /> <!-- Adjusted position and size -->
            {/if}
          </div>
        {/each}
      </div>
    </div>
  </div>
</section>
