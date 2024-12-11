<script lang="ts">
    let email = '';
    let password = '';
    let userName = '';
    let errorMessage = '';

    const handleSubmit = async () => {
        // Prepare the data to be sent
        const data = {
            userName,
            email,
            password
        };

        try {
            const response = await fetch('http://localhost/codemaster/codemasters-backend/modules/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            // Error Checking / Error response
            const result = await response.text();
            console.log(result); 

            if (response.ok) {
                console.log('Registered succesfully');
                window.location.href = '/login'; 
            }
        } catch (error) {
            console.error('Error:', error);
        }
    };
</script>


    <div class="flex flex-col min-h-screen md:flex-row">
        <div class="flex-1 bg-black flex items-center justify-center relative left-section">
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <div class="image-container">
                <img src="./codemasters-logo.png" alt="Fallback description if image fails to load" class="max-w-[900px] h-[900px]" aria-hidden="true" />
            </div>
            <div class="absolute bottom-10 left-10 text-white text-lg">
                <h1 class="font-bold">Welcome to Code Masters</h1>
                <p class="add">Embark on thrilling adventures using code to fight monsters!</p>
            </div>
        </div>
    <div class="flex-1 flex items-center justify-center">
        <form on:submit|preventDefault={handleSubmit} class="p-6 w-full md:w-2/3">
          <img src="./mini-logo.png" alt="Fallback description if image fails to load" class="max-w-[200px] h-[200px] mx-auto -mt-24" aria-hidden="true" />
            <h2 class="text-3xl font-extrabold mb-4 text-center text-gradient">Join Us on Your Journey!</h2>
            <p class="text-center mb-6 text-gray-600">To get started, please fill in your details to create an account.</p>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" bind:value={userName} required class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter your username"/>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" bind:value={email} required class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter your email"/>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" bind:value={password} required class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter your password"/>
            </div>
            
            <button type="submit" class="w-full bg-red-900 text-white p-2 rounded hover:bg-red-800">Register</button>
            <p class="mt-4 text-center">Already Have an Account? <button type="button" class="text-red-500" on:click={() => window.location.href='/login'}>Login Now</button></p>
            <p class="mt-2 text-center text-sm text-gray-500">Version 1.0.0 Developed by Michael Dayandante - Join the adventure!</p>
        </form>
    </div>
</div>
