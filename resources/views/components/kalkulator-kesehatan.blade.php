<!-- components/kalkulator-kesehatan.blade.php -->
<section id="kalkulator" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Kalkulator Kesehatan</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">
                Hitung dan pantau kesehatan Anda dengan alat kami
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
            
            <!-- Kalkulator BMI -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-weight-scale text-primary text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark">Hitung BMI Kamu di Sini!</h3>
                        <p class="text-gray-600 text-sm">Ketahui status berat badan ideal Anda</p>
                    </div>
                </div>

                <form id="bmi-form" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tinggi Badan (cm)</label>
                            <input type="number" id="tinggi" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                   placeholder="170" min="100" max="250" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Berat Badan (kg)</label>
                            <input type="number" id="berat" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                   placeholder="65" min="30" max="200" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="gender" value="pria" class="text-primary focus:ring-primary" checked>
                                <span class="ml-3 text-gray-700">Pria</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="gender" value="wanita" class="text-primary focus:ring-primary">
                                <span class="ml-3 text-gray-700">Wanita</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition flex items-center justify-center">
                        <i class="fas fa-calculator mr-2"></i>
                        Hitung BMI
                    </button>
                </form>

                <!-- Hasil BMI -->
                <div id="bmi-result" class="mt-6 p-4 bg-gray-50 rounded-lg hidden">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary mb-2" id="bmi-value">--</div>
                        <div class="text-lg font-semibold mb-2" id="bmi-category">--</div>
                        <div class="text-sm text-gray-600" id="bmi-description">--</div>
                    </div>
                    
                    <!-- Progress Bar BMI -->
                    <div class="mt-4">
                        <div class="flex justify-between text-xs text-gray-600 mb-1">
                            <span>Kurus</span>
                            <span>Normal</span>
                            <span>Gemuk</span>
                            <span>Obesitas</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div id="bmi-progress" class="bg-primary h-2 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-600 mt-1">
                            <span>18.5</span>
                            <span>25</span>
                            <span>30</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kalkulator Kalori -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-secondary bg-opacity-10 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-fire text-secondary text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark">Hitung Kebutuhan Kalori Harianmu!</h3>
                        <p class="text-gray-600 text-sm">Tentukan target kalori untuk goals Anda</p>
                    </div>
                </div>

                <form id="kalori-form" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Usia</label>
                            <input type="number" id="usia" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                   placeholder="25" min="15" max="80" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Aktivitas</label>
                            <select id="aktivitas" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="1.2">Sedentary (jarang olahraga)</option>
                                <option value="1.375">Ringan (1-3x/minggu)</option>
                                <option value="1.55" selected>Moderat (3-5x/minggu)</option>
                                <option value="1.725">Berat (6-7x/minggu)</option>
                                <option value="1.9">Sangat Berat (atlet)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Target</label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="flex flex-col items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="target" value="turun" class="text-primary focus:ring-primary">
                                <i class="fas fa-arrow-down text-red-500 text-lg mt-2"></i>
                                <span class="mt-2 text-sm text-gray-700 text-center">Turun Berat Badan</span>
                            </label>
                            <label class="flex flex-col items-center p-3 border border-primary rounded-lg cursor-pointer hover:bg-gray-50 bg-primary bg-opacity-5">
                                <input type="radio" name="target" value="pertahankan" class="text-primary focus:ring-primary" checked>
                                <i class="fas fa-minus text-primary text-lg mt-2"></i>
                                <span class="mt-2 text-sm text-gray-700 text-center">Pertahankan</span>
                            </label>
                            <label class="flex flex-col items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="target" value="naik" class="text-primary focus:ring-primary">
                                <i class="fas fa-arrow-up text-green-500 text-lg mt-2"></i>
                                <span class="mt-2 text-sm text-gray-700 text-center">Naik Berat Badan</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-secondary text-white py-3 rounded-lg font-bold hover:bg-accent transition flex items-center justify-center">
                        <i class="fas fa-fire mr-2"></i>
                        Hitung Kalori
                    </button>
                </form>

                <!-- Hasil Kalori -->
                <div id="kalori-result" class="mt-6 p-4 bg-gray-50 rounded-lg hidden">
                    <div class="text-center mb-4">
                        <div class="text-2xl font-bold text-secondary mb-2" id="kalori-value">--</div>
                        <div class="text-sm text-gray-600">Kalori per hari</div>
                    </div>
                    
                    <!-- Breakdown Kalori -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Karbohidrat (50%)</span>
                            <span class="text-sm font-semibold" id="karbo-value">-- gram</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Protein (30%)</span>
                            <span class="text-sm font-semibold" id="protein-value">-- gram</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Lemak (20%)</span>
                            <span class="text-sm font-semibold" id="lemak-value">-- gram</span>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="mt-4 p-3 bg-primary bg-opacity-10 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-lightbulb text-primary mt-1 mr-3"></i>
                            <p class="text-sm text-gray-700" id="kalori-tips">--</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Tambahan -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-primary"></i>
                </div>
                <h4 class="font-bold text-dark mb-2">Akurat</h4>
                <p class="text-sm text-gray-600">Perhitungan berdasarkan standar medis</p>
            </div>
            <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                <div class="w-12 h-12 bg-secondary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-secondary"></i>
                </div>
                <h4 class="font-bold text-dark mb-2">Privasi Terjaga</h4>
                <p class="text-sm text-gray-600">Data Anda tidak disimpan</p>
            </div>
            <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                <div class="w-12 h-12 bg-accent bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-accent"></i>
                </div>
                <h4 class="font-bold text-dark mb-2">Gratis</h4>
                <p class="text-sm text-gray-600">Tidak ada biaya untuk kalkulator</p>
            </div>
        </div>
    </div>
</section>

<script>
    // BMI Calculator
    document.getElementById('bmi-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const tinggi = parseFloat(document.getElementById('tinggi').value) / 100; // Convert to meters
        const berat = parseFloat(document.getElementById('berat').value);
        const gender = document.querySelector('input[name="gender"]:checked').value;
        
        if (tinggi && berat) {
            const bmi = berat / (tinggi * tinggi);
            displayBMIResult(bmi, gender);
        }
    });

    function displayBMIResult(bmi, gender) {
        const bmiValue = document.getElementById('bmi-value');
        const bmiCategory = document.getElementById('bmi-category');
        const bmiDescription = document.getElementById('bmi-description');
        const bmiProgress = document.getElementById('bmi-progress');
        const resultDiv = document.getElementById('bmi-result');
        
        bmiValue.textContent = bmi.toFixed(1);
        
        let category, description, color, progressWidth;
        
        if (bmi < 18.5) {
            category = 'Kurus';
            description = 'Disarankan untuk menambah berat badan secara sehat';
            color = 'text-yellow-500';
            progressWidth = (bmi / 18.5) * 25;
        } else if (bmi < 25) {
            category = 'Normal';
            description = 'Berat badan Anda ideal, pertahankan!';
            color = 'text-green-500';
            progressWidth = 25 + ((bmi - 18.5) / 6.5) * 25;
        } else if (bmi < 30) {
            category = 'Gemuk';
            description = 'Disarankan untuk menurunkan berat badan';
            color = 'text-orange-500';
            progressWidth = 50 + ((bmi - 25) / 5) * 25;
        } else {
            category = 'Obesitas';
            description = 'Sangat disarankan untuk berkonsultasi dengan ahli gizi';
            color = 'text-red-500';
            progressWidth = 75 + ((bmi - 30) / 10) * 25;
        }
        
        bmiCategory.textContent = category;
        bmiCategory.className = `text-lg font-semibold mb-2 ${color}`;
        bmiDescription.textContent = description;
        bmiProgress.style.width = `${Math.min(progressWidth, 100)}%`;
        
        resultDiv.classList.remove('hidden');
    }

    // Kalori Calculator
    document.getElementById('kalori-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const tinggi = parseFloat(document.getElementById('tinggi').value);
        const berat = parseFloat(document.getElementById('berat').value);
        const usia = parseInt(document.getElementById('usia').value);
        const gender = document.querySelector('input[name="gender"]:checked').value;
        const aktivitas = parseFloat(document.getElementById('aktivitas').value);
        const target = document.querySelector('input[name="target"]:checked').value;
        
        if (tinggi && berat && usia) {
            const bmr = calculateBMR(berat, tinggi, usia, gender);
            const tdee = bmr * aktivitas;
            const targetKalori = adjustForTarget(tdee, target);
            displayKaloriResult(targetKalori, target);
        }
    });

    function calculateBMR(berat, tinggi, usia, gender) {
        if (gender === 'pria') {
            return 88.362 + (13.397 * berat) + (4.799 * tinggi) - (5.677 * usia);
        } else {
            return 447.593 + (9.247 * berat) + (3.098 * tinggi) - (4.330 * usia);
        }
    }

    function adjustForTarget(tdee, target) {
        switch(target) {
            case 'turun':
                return tdee - 500; // Defisit 500 kalori
            case 'naik':
                return tdee + 500; // Surplus 500 kalori
            default:
                return tdee; // Maintain
        }
    }

    function displayKaloriResult(kalori, target) {
        const kaloriValue = document.getElementById('kalori-value');
        const karboValue = document.getElementById('karbo-value');
        const proteinValue = document.getElementById('protein-value');
        const lemakValue = document.getElementById('lemak-value');
        const kaloriTips = document.getElementById('kalori-tips');
        const resultDiv = document.getElementById('kalori-result');
        
        kaloriValue.textContent = Math.round(kalori);
        
        // Calculate macronutrients (standard distribution)
        const karboGram = Math.round((kalori * 0.5) / 4); // 4 cal/gram
        const proteinGram = Math.round((kalori * 0.3) / 4); // 4 cal/gram
        const lemakGram = Math.round((kalori * 0.2) / 9); // 9 cal/gram
        
        karboValue.textContent = `${karboGram}g`;
        proteinValue.textContent = `${proteinGram}g`;
        lemakValue.textContent = `${lemakGram}g`;
        
        // Set tips based on target
        let tips = '';
        switch(target) {
            case 'turun':
                tips = 'Kombinasikan dengan olahraga kardio 3-4x seminggu untuk hasil optimal.';
                break;
            case 'naik':
                tips = 'Fokus pada protein dan karbohidrat kompleks untuk menambah massa otot.';
                break;
            default:
                tips = 'Pertahankan pola makan sehat dan rutin berolahraga untuk menjaga berat badan ideal.';
        }
        
        kaloriTips.textContent = tips;
        resultDiv.classList.remove('hidden');
    }

    // Auto-calculate when all BMI fields are filled
    document.getElementById('tinggi').addEventListener('input', autoCalculateBMI);
    document.getElementById('berat').addEventListener('input', autoCalculateBMI);

    function autoCalculateBMI() {
        const tinggi = document.getElementById('tinggi').value;
        const berat = document.getElementById('berat').value;
        
        if (tinggi && berat) {
            // Trigger form submission after a short delay
            setTimeout(() => {
                document.getElementById('bmi-form').dispatchEvent(new Event('submit'));
            }, 500);
        }
    }
</script>

<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    input[type="number"] {
        -moz-appearance: textfield;
    }
    
    .calculator-card {
        transition: all 0.3s ease;
    }
    
    .calculator-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>