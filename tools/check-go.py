import os
import subprocess
import ast
import tempfile

def check_syntax_go(filepath):
    import tempfile

    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            code = f.read()

        if not code.strip().startswith("package"):
            code = "package main\n\n" + code

        # Write original code to temp file
        with tempfile.NamedTemporaryFile(mode='w', suffix='.go', delete=False) as code_file:
            code_file.write(code)
            code_path = code_file.name

        # Run the precompiled checker (assumes go_syntax_checker is in the same directory)
        result = subprocess.run(['./go_syntax_checker', code_path],
                                stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True)
        if result.returncode != 0:
            print("❌ Syntax error:")
            print(result.stderr)
        else:
            print("✅ Syntax is valid.")
        return result.returncode == 0

    except Exception as e:
        print("Exception:", e)
        return False
    finally:
        if result.returncode != 0:
            print("Compilation failed with error message:")
            print(result.stderr)
        else:
            print("Compilation succeeded.")
        if os.path.exists(code_path):
            os.remove(code_path)



# ./dataset/go/0462caccbb9cc0b222a2d75a64830c360c603798.go

check_syntax_go('./dataset/go/0462caccbb9cc0b222a2d75a64830c360c603798.go')