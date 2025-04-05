import os
import subprocess
import ast
import tempfile
import csv

LANGUAGES = ['go', 'java', 'javascript', 'php', 'python', 'ruby']
BASE_DIR = 'dataset'
OUTPUT_CSV = 'syntax_check_results.csv'

def check_syntax_python(filepath):
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            code = f.read()
        ast.parse(code)
        return True, ""
    except SyntaxError as e:
        return False, str(e)

def check_syntax_subprocess(command):
    try:
        result = subprocess.run(command, stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True)
        return result.returncode == 0, result.stderr.strip()
    except Exception as e:
        return False, str(e)

def check_syntax_go(filepath):
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            code = f.read()
        if not code.strip().startswith("package"):
            code = "package main\n\n" + code
        with tempfile.NamedTemporaryFile(mode='w', suffix='.go', delete=False) as code_file:
            code_file.write(code)
            code_path = code_file.name
        result = subprocess.run(['./go_syntax_checker', code_path],
                                stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True)
        return result.returncode == 0, result.stderr.strip()
    except Exception as e:
        return False, str(e)
    finally:
        if os.path.exists(code_path):
            os.remove(code_path)

def check_syntax_javascript(filepath):
    import tempfile
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            original_code = f.read()

        # Wrap into IIFE if needed (to make function expressions valid)
        if original_code.strip().startswith("function("):
            wrapped_code = f"(function() {{\n{original_code}\n}})();"
        else:
            wrapped_code = original_code

        with tempfile.NamedTemporaryFile(mode='w', suffix='.js', delete=False) as tmp_file:
            tmp_file.write(wrapped_code)
            tmp_path = tmp_file.name

        result = subprocess.run(['node', '--check', tmp_path],
                                stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True)

        if result.returncode == 0:
            return True, ""
        else:
            return False, result.stderr.strip()
    except Exception as e:
        return False, str(e)
    finally:
        if 'tmp_path' in locals() and os.path.exists(tmp_path):
            os.remove(tmp_path)


def check_syntax_java(filepath):
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            original_code = f.read()
        # first_line = original_code.split('\n')[0].strip()
        # if "class" not in first_line:
        wrapped_code = "public class SyntaxWrapper {\n" + original_code + "\n}"
        # else:
            # wrapped_code = original_code
        with tempfile.NamedTemporaryFile(mode='w', suffix='.java', delete=False) as tmp_file:
            tmp_file.write(wrapped_code)
            tmp_path = tmp_file.name
        sep = ';' if os.name == 'nt' else ':'
        classpath = f".{sep}javaparser-core-3.25.4.jar"
        result = subprocess.run([
            'java',
            '-cp', classpath,
            'JavaSyntaxChecker',
            tmp_path
        ], stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True)
        if "INVALID" in result.stdout:
            return False, result.stderr.strip()
        elif "VALID" in result.stdout:
            return True, ""
        return False, result.stderr.strip()
    except Exception as e:
        return False, str(e)
    finally:
        if 'tmp_path' in locals() and os.path.exists(tmp_path):
            os.remove(tmp_path)

def check_file_syntax(language, filepath):
    if language == 'go':
        return check_syntax_go(filepath)
    elif language == 'java':
        return check_syntax_java(filepath)
    elif language == 'javascript':
        return check_syntax_javascript(filepath)
    elif language == 'php':
        return check_syntax_subprocess(['php', '-l', filepath])
    elif language == 'python':
        return check_syntax_python(filepath)
    elif language == 'ruby':
        return check_syntax_subprocess(['ruby', '-c', filepath])
    else:
        return False, "Unsupported language"

def check_all_languages():
    results = []
    for lang in LANGUAGES:
        dir_path = os.path.join(BASE_DIR, lang)
        if not os.path.exists(dir_path):
            print(f"Directory {dir_path} not found.")
            continue
        print(f"\nChecking syntax for language: {lang}")
        for filename in os.listdir(dir_path):
            file_path = os.path.join(dir_path, filename)
            if os.path.isfile(file_path):
                is_valid, error_message = check_file_syntax(lang, file_path)
                results.append({
                    'language': lang,
                    'file': filename,
                    'valid': is_valid,
                    'error': error_message
                })
    # Save to CSV
    with open(OUTPUT_CSV, 'w', newline='', encoding='utf-8') as csvfile:
        fieldnames = ['language', 'file', 'valid', 'error']
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
        writer.writeheader()
        for row in results:
            writer.writerow(row)

check_all_languages()
