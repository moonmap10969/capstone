<title>Grades - FUMCES</title>

<!-- Sidebar -->
@include('layouts.sidebar')

<!-- Main Content -->
<main class="flex-1 bg-yellow-50 p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Grades</h1>

    <div class="max-w-5xl mx-auto">

        <!-- Grades Table -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Course Grades by Quarter</h2>
            <table class="w-full table-auto border-collapse text-center">
                <thead>
                    <tr class="bg-green-700 text-white">
                        <th class="py-3 px-4 rounded-tl-lg text-left">Course</th>
                        <th class="py-3 px-4">1st Qtr</th>
                        <th class="py-3 px-4">2nd Qtr</th>
                        <th class="py-3 px-4">3rd Qtr</th>
                        <th class="py-3 px-4">4th Qtr</th>
                        <th class="py-3 px-4">Final Grade</th>
                        <th class="py-3 px-4 rounded-tr-lg">Remarks</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    <!-- Failed Example -->
                    <tr class="bg-red-50 hover:bg-red-100 transition">
                        <td class="py-3 px-4 font-semibold text-left">History 101</td>
                        <td class="py-3 px-4">60</td>
                        <td class="py-3 px-4">62</td>
                        <td class="py-3 px-4">64</td>
                        <td class="py-3 px-4">65</td>
                        <td class="py-3 px-4">
                            <span class="inline-block bg-red-600 text-white px-3 py-1 rounded-full font-semibold">63</span>
                        </td>
                        <td class="py-3 px-4 text-red-600 font-semibold">Failed</td>
                    </tr>

                    <!-- Pass Example -->
                    <tr class="bg-orange-50 hover:bg-orange-100 transition">
                        <td class="py-3 px-4 font-semibold text-left">Physics 102</td>
                        <td class="py-3 px-4">75</td>
                        <td class="py-3 px-4">78</td>
                        <td class="py-3 px-4">80</td>
                        <td class="py-3 px-4">82</td>
                        <td class="py-3 px-4">
                            <span class="inline-block bg-orange-500 text-white px-3 py-1 rounded-full font-semibold">79</span>
                        </td>
                        <td class="py-3 px-4 text-orange-500 font-semibold">Pass</td>
                    </tr>

                    <!-- Good Example -->
                    <tr class="bg-yellow-50 hover:bg-yellow-100 transition">
                        <td class="py-3 px-4 font-semibold text-left">English Literature</td>
                        <td class="py-3 px-4">85</td>
                        <td class="py-3 px-4">87</td>
                        <td class="py-3 px-4">88</td>
                        <td class="py-3 px-4">90</td>
                        <td class="py-3 px-4">
                            <span class="inline-block bg-yellow-400 text-white px-3 py-1 rounded-full font-semibold">88</span>
                        </td>
                        <td class="py-3 px-4 text-yellow-400 font-semibold">Good</td>
                    </tr>

                    <!-- Excellent Example -->
                    <tr class="bg-green-50 hover:bg-green-100 transition">
                        <td class="py-3 px-4 font-semibold text-left">Mathematics 101</td>
                        <td class="py-3 px-4">95</td>
                        <td class="py-3 px-4">97</td>
                        <td class="py-3 px-4">98</td>
                        <td class="py-3 px-4">100</td>
                        <td class="py-3 px-4">
                            <span class="inline-block bg-green-600 text-white px-3 py-1 rounded-full font-semibold">97</span>
                        </td>
                        <td class="py-3 px-4 text-green-600 font-semibold">Excellent</td>
                    </tr>

                    <!-- Borderline Examples -->
                    <tr class="bg-orange-50 hover:bg-orange-100 transition">
                        <td class="py-3 px-4 font-semibold text-left">Biology 101</td>
                        <td class="py-3 px-4">75</td>
                        <td class="py-3 px-4">76</td>
                        <td class="py-3 px-4">78</td>
                        <td class="py-3 px-4">80</td>
                        <td class="py-3 px-4">
                            <span class="inline-block bg-orange-500 text-white px-3 py-1 rounded-full font-semibold">77</span>
                        </td>
                        <td class="py-3 px-4 text-orange-500 font-semibold">Pass</td>
                    </tr>

                    <tr class="bg-yellow-50 hover:bg-yellow-100 transition">
                        <td class="py-3 px-4 font-semibold text-left">Chemistry 101</td>
                        <td class="py-3 px-4">85</td>
                        <td class="py-3 px-4">86</td>
                        <td class="py-3 px-4">89</td>
                        <td class="py-3 px-4">90</td>
                        <td class="py-3 px-4">
                            <span class="inline-block bg-yellow-400 text-white px-3 py-1 rounded-full font-semibold">88</span>
                        </td>
                        <td class="py-3 px-4 text-yellow-400 font-semibold">Good</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- GPA / Summary -->
        <div class="bg-white p-6 rounded shadow mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Summary</h2>
            <p class="text-gray-700">Current GPA: <span class="font-semibold text-green-700">2.75</span></p>
            <p class="text-gray-700 mt-2">Remarks: <span class="font-semibold text-green-700">Good Standing</span></p>
        </div>

    </div>
</main>
