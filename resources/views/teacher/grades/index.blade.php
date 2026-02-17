<!DOCTYPE html>
<html lang="en" x-data="gradesPage()" x-cloak>
<head>
    <meta charset="UTF-8">
    <title>Grades</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md">
        @include('layouts.sidebar.teacher')
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8 space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Grades</h1>
                <p class="text-gray-500 text-sm">Manage student grades across subjects.</p>
            </div>

            <button @click="openAdd"
                class="bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700">
                + Add Grade
            </button>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-xl shadow">

            {{-- Card Header --}}
            <div class="flex justify-between items-center p-4 border-b">
                <h2 class="font-bold">All Grades</h2>

                <select x-model="filterSubject"
                    class="border rounded-lg p-2">
                    <option value="all">All Subjects</option>
                    <template x-for="s in subjects" :key="s">
                        <option x-text="s"></option>
                    </template>
                </select>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-sm">
                        <tr>
                            <th class="p-4">Student</th>
                            <th class="p-4">Subject</th>
                            <th class="p-4">Grade</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">

                        <template x-for="s in filteredStudents()" :key="s.id">
                            <tr>
                                <td class="p-4 font-medium" x-text="s.name"></td>
                                <td class="p-4" x-text="s.subject"></td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded text-sm font-bold"
                                          :class="gradeColor(s.grade)"
                                          x-text="s.grade + '%'"></span>
                                </td>
                                <td class="p-4 text-right space-x-2">
                                    <button @click="openEdit(s)"
                                        class="text-blue-600 hover:underline">Edit</button>
                                    <button @click="remove(s.id)"
                                        class="text-red-600 hover:underline">Delete</button>
                                </td>
                            </tr>
                        </template>

                        <tr x-show="filteredStudents().length === 0">
                            <td colspan="4" class="p-8 text-center text-gray-400">
                                No grades found.
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal --}}
        <div x-show="dialogOpen"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

            <div @click.away="dialogOpen=false"
                class="bg-white w-full max-w-md rounded-xl p-6 space-y-4">

                <h2 class="font-bold text-lg"
                    x-text="editing ? 'Edit Grade' : 'Add Grade'"></h2>

                <div>
                    <label class="text-sm font-semibold">Student Name</label>
                    <input x-model="form.name"
                        class="w-full border p-2 rounded-lg">
                </div>

                <div>
                    <label class="text-sm font-semibold">Grade (%)</label>
                    <input type="number" min="0" max="100"
                        x-model="form.grade"
                        class="w-full border p-2 rounded-lg">
                </div>

                <div>
                    <label class="text-sm font-semibold">Subject</label>
                    <select x-model="form.subject"
                        class="w-full border p-2 rounded-lg">
                        <option value="">Select subject</option>
                        <template x-for="s in subjects" :key="s">
                            <option x-text="s"></option>
                        </template>
                    </select>
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <button @click="dialogOpen=false"
                        class="px-4 py-2 rounded-lg bg-gray-100">Cancel</button>
                    <button @click="save"
                        class="px-4 py-2 rounded-lg bg-green-600 text-white">
                        Save
                    </button>
                </div>
            </div>
        </div>

    </main>
</div>

<script>
function gradesPage() {
    return {
        subjects: ['Mathematics', 'Science', 'English'],
        students: @json($students ?? []),
        dialogOpen: false,
        editing: false,
        editingId: null,
        filterSubject: 'all',

        form: { name: '', grade: '', subject: '' },

        filteredStudents() {
            if (this.filterSubject === 'all') return this.students
            return this.students.filter(s => s.subject === this.filterSubject)
        },

        gradeColor(g) {
            return g >= 90 ? 'bg-green-100 text-green-700'
                 : g >= 80 ? 'bg-blue-100 text-blue-700'
                 : g >= 70 ? 'bg-yellow-100 text-yellow-700'
                 : 'bg-red-100 text-red-700'
        },

        openAdd() {
            this.editing = false
            this.form = { name:'', grade:'', subject:'' }
            this.dialogOpen = true
        },

        openEdit(s) {
            this.editing = true
            this.editingId = s.id
            this.form = { ...s }
            this.dialogOpen = true
        },

        save() {
            if (!this.form.name || !this.form.grade || !this.form.subject) return

            if (this.editing) {
                const i = this.students.findIndex(s => s.id === this.editingId)
                this.students[i] = { ...this.students[i], ...this.form }
            } else {
                this.students.push({ id: Date.now(), ...this.form })
            }

            this.dialogOpen = false
        },

        remove(id) {
            this.students = this.students.filter(s => s.id !== id)
        }
    }
}
</script>

</body>
</html>
