<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4">Tailwind CSS Test</h1>
        
        <!-- Basic Tailwind Classes -->
        <div class="bg-blue-500 text-white p-4 rounded mb-4">
            This should have a blue background and white text
        </div>
        
        <!-- Custom Classes -->
        <div class="text-huge mb-4">
            This text should be huge (5rem)
        </div>
        
        <div class="bg-special text-white p-4 rounded mb-4">
            This should have a purple background
        </div>
        
        <!-- Test for utilities -->
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="bg-red-500 p-4 text-white rounded">Column 1</div>
            <div class="bg-green-500 p-4 text-white rounded">Column 2</div>
            <div class="bg-yellow-500 p-4 text-white rounded">Column 3</div>
        </div>
        
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Hover over me
        </button>
    </div>
</body>
</html> 