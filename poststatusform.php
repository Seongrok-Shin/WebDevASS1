<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Web Development Assignment 1</title>
</head>

<body>
    <div class="m-10 flex items-center justify-center md:flex-row flex-col">
        <h1 class="text-3xl font-bold font-sans">Status Posting System</h1>
    </div>
    <div class="m-10 flex items-center justify-center md:flex-row flex-col">

        <!-- post method to poststatusprocess.php -->
        <form method="post" action="poststatusprocess.php">
            <!-- text type to put data into statuscode for query which is required only start with S and 4 digts-->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="statusCode">Status Code:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" name="statuscode" id="statuscode" required pattern="S\d{4}">
            </div>
            <!-- text type to put data into status for query which cannot be blank-->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="status">Status:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" name="status" id="status" required pattern="^(?!\s*$)[a-zA-Z0-9,.!? ]+$">
            </div>
            <!-- radio type to check the share with public, firends or onlyme -->
            <div class="flex-col items-center mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Share:</label>
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                type="radio" name="share" value="public" id="public">
                <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="public">Public</label>
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                type="radio" name="share" value="friends" id="friends">
                <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="friends">Friends</label>
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                type="radio" name="share" value="onlyme" id="onlyme">
                <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="onlyme">Only Me</label>
            </div>
            <!-- Date can be edited, and also the pattern required format of dd/mm/yyyy -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="date">Date:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" name="date" id="date" required pattern="\d{2}/\d{2}/\d{4}"
                    title="Date must be in the format of dd/mm/yyyy" value="<?php echo date('d/m/Y'); ?>">
            </div>
            <!-- Permission is the checkboxes as allowlike, allowcomment, and allowshare. User can check more than one -->
            <div class="flex-col items-center mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission:</label>
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                 type="checkbox" name="checkbox[]" value="Allow like" id="allowlike">
                Allow Like
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                 type="checkbox" name="checkbox[]" value="Allow comments" id="allowcomment">
                Allow Comments
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                 type="checkbox" name="checkbox[]" value="Allow share" id="allowshare">
                Allow Share
            </div>
            <!-- type of submit to post the data into given php file. -->
            <button class="py-2 px-4 font-semibold rounded-lg shadow-md
        text-white bg-green-500 hover:bg-green-700" type="submit">Post</button>
        
            <button class="py-2 px-4 font-semibold rounded-lg shadow-md
            text-white bg-green-500 hover:bg-green-700" onclick="location.href='index.html'">
                Homepage
            </button>
        </form>
    </div>
</body>