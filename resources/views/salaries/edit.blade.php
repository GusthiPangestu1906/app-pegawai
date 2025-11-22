@extends('layouts.admin')

@section('title', 'Edit Gaji')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Edit Data Gaji</h2>
                <p class="text-sm text-gray-500">Pegawai: <strong>{{ $salary->employee->name ?? 'Unknown' }}</strong></p>
            </div>

            <form action="{{ route('salaries.update', $salary->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Gaji Pokok -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gaji Pokok</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="base_salary" value="{{ old('base_salary', $salary->base_salary) }}" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" required>
                        </div>
                    </div>

                    <!-- Tunjangan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tunjangan</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="allowance" value="{{ old('allowance', $salary->allowance) }}" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                        </div>
                    </div>

                    <!-- Bonus -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bonus</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="bonus" value="{{ old('bonus', $salary->bonus) }}" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                        </div>
                    </div>

                    <!-- Potongan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Potongan</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="deduction" value="{{ old('deduction', $salary->deduction) }}" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('salaries.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow-sm">Update Gaji</button>
                </div>
            </form>
        </div>
    </div>
@endsection