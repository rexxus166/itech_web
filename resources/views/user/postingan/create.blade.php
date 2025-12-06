@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Code Editor</h1>

    <form action="{{ route('postingan.store') }}" method="POST" id="codeForm">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="judul" class="form-label">Judul Kode</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Program Hello World" required>
            </div>
            <div class="col-md-6">
                <label for="bahasa" class="form-label">Pilih Bahasa</label>
                <select class="form-select" id="bahasa" name="bahasa" required>
                    <option value="python">Python</option>
                    <option value="cpp">C++</option>
                </select>
            </div>
        </div>

        <!-- Code Editor Section -->
        <div class="card mb-3">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-code"></i> Editor Kode -
                    <span id="currentLanguage">Python</span>
                </span>
                <div>
                    <button type="button" class="btn btn-sm btn-outline-light me-2" onclick="runCode()">
                        <i class="fas fa-play"></i> Run
                    </button>
                    <button type="submit" class="btn btn-sm btn-success" onclick="updateTextarea()">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="codeEditor" style="height: 400px;"></div>
                <textarea name="konten" id="konten" class="d-none"></textarea>
            </div>
        </div>

        <!-- Input Section -->
        <div class="card mb-3">
            <div class="card-header bg-secondary text-white">
                <i class="fas fa-keyboard"></i> Input (Opsional)
                <small class="float-end">Gunakan area ini untuk memberikan input ke program</small>
            </div>
            <div class="card-body">
                <textarea class="form-control" id="userInput" rows="4" placeholder="Masukkan input di sini (contoh: 5&#10;John&#10;10 20 30)"></textarea>
                <div class="form-text">
                    Pisahkan setiap input dengan baris baru. Untuk multiple inputs, gunakan satu input per baris.
                </div>
            </div>
        </div>

        <!-- Result Section -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-eye"></i> Result
            </div>
            <div class="card-body">
                <div id="result" style="min-height: 100px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
                    <p class="text-muted">Klik "Run" untuk melihat hasil eksekusi kode...</p>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Load CodeMirror -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/monokai.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/python/python.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/mode/clike/clike.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/addon/edit/closebrackets.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/addon/edit/matchbrackets.min.js"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
    let editor = CodeMirror(document.getElementById("codeEditor"), {
        lineNumbers: true,
        mode: "python",
        theme: "monokai",
        indentUnit: 4,
        smartIndent: true,
        lineWrapping: true,
        matchBrackets: true,
        autoCloseBrackets: true,
        extraKeys: {
            "Ctrl-Space": "autocomplete",
            "Ctrl-Enter": function() { runCode(); },
            "Ctrl-S": function() { updateTextarea(); document.getElementById('codeForm').submit(); }
        }
    });

    // Default Python code dengan contoh input
    editor.setValue(`# Contoh program Python dengan input
nama = input("Masukkan nama Anda: ")
umur = int(input("Masukkan umur Anda: "))

print(f"Halo {nama}! Umur Anda {umur} tahun.")

# Contoh dengan multiple inputs
print("\\\\n=== Contoh Multiple Inputs ===")
numbers = input("Masukkan beberapa angka (pisahkan dengan spasi): ").split()
numbers = [int(x) for x in numbers]
print(f"Angka yang dimasukkan: {numbers}")
print(f"Total: {sum(numbers)}")`);

    // Change mode based on language selection
    document.getElementById('bahasa').addEventListener('change', function() {
        const language = this.value;
        const languageNames = {
            'python': 'Python',
            'cpp': 'C++'
        };

        document.getElementById('currentLanguage').textContent = languageNames[language];

        if (language === 'python') {
            editor.setOption('mode', 'python');
            editor.setValue(`# Contoh program Python dengan input
nama = input("Masukkan nama Anda: ")
umur = int(input("Masukkan umur Anda: "))

print(f"Halo {nama}! Umur Anda {umur} tahun.")

# Contoh dengan multiple inputs
print("\\\\n=== Contoh Multiple Inputs ===")
numbers = input("Masukkan beberapa angka (pisahkan dengan spasi): ").split()
numbers = [int(x) for x in numbers]
print(f"Angka yang dimasukkan: {numbers}")
print(f"Total: {sum(numbers)}")`);
        } else if (language === 'cpp') {
            editor.setOption('mode', 'text/x-c++src');
            editor.setValue(`#include <iostream>
#include <vector>
#include <sstream>
using namespace std;

int main() {
    // Contoh program C++ dengan input
    string nama;
    int umur;

    cout << "Masukkan nama Anda: ";
    getline(cin, nama);

    cout << "Masukkan umur Anda: ";
    cin >> umur;
    cin.ignore(); // Membersihkan newline

    cout << "Halo " << nama << "! Umur Anda " << umur << " tahun." << endl;

    // Contoh dengan multiple inputs
    cout << "\\\\n=== Contoh Multiple Inputs ===" << endl;
    cout << "Masukkan beberapa angka (pisahkan dengan spasi): ";

    string line;
    getline(cin, line);
    stringstream ss(line);
    vector<int> numbers;
    int num;

    while (ss >> num) {
        numbers.push_back(num);
    }

    int total = 0;
    for (int n : numbers) {
        total += n;
    }

    cout << "Angka yang dimasukkan: ";
    for (int i = 0; i < numbers.size(); i++) {
        cout << numbers[i];
        if (i < numbers.size() - 1) cout << ", ";
    }
    cout << endl;
    cout << "Total: " << total << endl;

    return 0;
}`);
        }
    });

    function updateTextarea() {
        document.getElementById('konten').value = editor.getValue();
    }

    function runCode() {
        const code = editor.getValue();
        const language = document.getElementById('bahasa').value;
        const userInput = document.getElementById('userInput').value;
        const resultDiv = document.getElementById('result');

        resultDiv.innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Menjalankan kode...</p></div>';

        // Simulasi eksekusi dengan input
        setTimeout(() => {
            try {
                let output = simulateCodeExecution(code, language, userInput);
                resultDiv.innerHTML = `
                    <div class="alert alert-info">
                        <strong>Output:</strong>
                        <pre class="mt-2 p-2 bg-dark text-white rounded">${output}</pre>
                    </div>
                    <div class="alert alert-success mt-2">
                        <i class="fas fa-check-circle"></i> Program berhasil dijalankan
                    </div>
                `;
            } catch (error) {
                resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <strong>Error:</strong> ${error.message}
                    </div>
                `;
            }
        }, 1000);
    }

    function simulateCodeExecution(code, language, userInput) {
        // Split input by lines
        const inputLines = userInput.split('\n').filter(line => line.trim() !== '');
        let inputIndex = 0;

        // Simulate input function
        const simulatedInput = (promptText = '') => {
            if (inputIndex < inputLines.length) {
                return inputLines[inputIndex++];
            }
            return ''; // Return empty string if no more input
        };

        if (language === 'python') {
            return simulatePython(code, simulatedInput);
        } else if (language === 'cpp') {
            return simulateCpp(code, simulatedInput);
        }
        return 'Bahasa tidak didukung';
    }

    function simulatePython(code, inputFn) {
        let output = '';
        const originalConsoleLog = console.log;

        // Override console.log and print to capture output
        console.log = function(...args) {
            output += args.join(' ') + '\n';
        };

        // Override input function
        const originalInput = window.input;
        window.input = inputFn;

        try {
            // Simple Python simulation (very basic)
            if (code.includes('input(')) {
                // For demonstration, we'll create a simple simulation
                output += "=== Simulasi Python dengan Input ===\n";

                // Extract input prompts and simulate
                const inputRegex = /input\(([^)]*)\)/g;
                let match;
                let simulatedOutput = code;

                while ((match = inputRegex.exec(code)) !== null) {
                    const prompt = match[1] || '';
                    const userValue = inputFn(prompt);
                    simulatedOutput = simulatedOutput.replace(match[0], `"${userValue}"`);
                }

                // Remove print statements and simulate execution
                const printRegex = /print\(([^)]*)\)/g;
                let printMatch;

                while ((printMatch = printRegex.exec(code)) !== null) {
                    try {
                        const expression = printMatch[1];
                        // Simple evaluation for demonstration
                        if (expression.includes('f"')) {
                            // Handle f-strings
                            const evalResult = eval('`' + expression.slice(2, -1) + '`');
                            output += evalResult + '\n';
                        } else {
                            const evalResult = eval(expression);
                            output += evalResult + '\n';
                        }
                    } catch (e) {
                        output += `[Output dari: print(${printMatch[1]})]\n`;
                    }
                }

                if (!printRegex.test(code)) {
                    output += "Program dijalankan (simulasi input berhasil)\n";
                }
            } else {
                output += "Program Python dijalankan (tanpa input)\n";
                // Simple print statement extraction
                const printRegex = /print\(([^)]*)\)/g;
                let match;
                while ((match = printRegex.exec(code)) !== null) {
                    output += `[Output: ${match[1]}]\n`;
                }
            }
        } catch (error) {
            output += `Error dalam simulasi: ${error.message}\n`;
        } finally {
            // Restore original functions
            console.log = originalConsoleLog;
            window.input = originalInput;
        }

        return output || 'Tidak ada output yang dihasilkan';
    }

    function simulateCpp(code, inputFn) {
        let output = '';

        try {
            output += "=== Simulasi C++ dengan Input ===\n";

            // Simple simulation for C++ input/output
            if (code.includes('cin >>') || code.includes('getline(cin')) {
                // Simulate input operations
                const inputVars = [];
                const cinRegex = /cin\s*>>\s*([^;]+);/g;
                let match;

                while ((match = cinRegex.exec(code)) !== null) {
                    const vars = match[1].split('>>').map(v => v.trim());
                    inputVars.push(...vars);
                }

                // Simulate output
                const coutRegex = /cout\s*<<\s*([^;]+);/g;
                let coutMatch;

                while ((coutMatch = coutRegex.exec(code)) !== null) {
                    let coutContent = coutMatch[1];
                    // Replace endl with newline
                    coutContent = coutContent.replace(/endl/g, '\\\\n');
                    // Remove extra spaces around <<
                    coutContent = coutContent.replace(/\s*<<\s*/g, ' ');
                    output += coutContent + '\\\\n';
                }

                if (inputVars.length > 0) {
                    output += `\\\\n[Input yang akan dimasukkan: ${inputVars.join(', ')}]\\\\n`;
                    output += `[Nilai input: ${inputVars.map(() => inputFn()).join(', ')}]\\\\n`;
                }

                if (!coutRegex.test(code)) {
                    output += "Program C++ dijalankan (simulasi input berhasil)\n";
                }
            } else {
                output += "Program C++ dijalankan (tanpa input)\n";
                // Extract cout statements
                const coutRegex = /cout\s*<<\s*([^;]+);/g;
                let match;
                while ((match = coutRegex.exec(code)) !== null) {
                    let content = match[1].replace(/endl/g, '\\\\n').replace(/\s*<<\s*/g, ' ');
                    output += content + '\\\\n';
                }
            }
        } catch (error) {
            output += `Error dalam simulasi C++: ${error.message}\n`;
        }

        return output || 'Tidak ada output yang dihasilkan';
    }

    // Auto-save textarea when form is submitted
    document.getElementById('codeForm').addEventListener('submit', function(e) {
        updateTextarea();
    });

    // Example input helper
    document.getElementById('userInput').addEventListener('focus', function() {
        const language = document.getElementById('bahasa').value;
        if (this.value === '') {
            if (language === 'python') {
                this.placeholder = "Contoh:\\\\nJohn\\\\n25\\\\n10 20 30";
            } else {
                this.placeholder = "Contoh:\\\\nJohn\\\\n25\\\\n10 20 30";
            }
        }
    });
</script>

<style>
    .CodeMirror {
        height: 400px;
        font-size: 14px;
        font-family: 'Consolas', 'Monaco', 'Courier New', monospace;
    }

    .card {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .card-header {
        font-weight: bold;
    }

    .form-label {
        font-weight: 600;
    }

    #result pre {
        margin: 0;
        font-family: 'Consolas', 'Monaco', 'Courier New', monospace;
        white-space: pre-wrap;
    }

    #userInput {
        font-family: 'Consolas', 'Monaco', 'Courier New', monospace;
        font-size: 14px;
    }
</style>
@endsection
