import os
import subprocess
import ast
import tempfile

import os
import subprocess
import tempfile

def check_syntax_java(filepath):
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            original_code = f.read()

        # If the snippet doesn't contain a class declaration,
        # wrap it in a dummy class so it forms a valid compilation unit.
        # first line
        first_line = original_code.split('\n')[0].strip()
        # ";" "@" "\u001a" "abstract" "class" "default" "enum" "final" "import" "interface" "module" "native" "non-sealed" "open" "private" "protected" "public" "record" "sealed" "static" "strictfp" "synchronized" "transient" "transitive"
        if "class" not in first_line:
            wrapped_code = "public class SyntaxWrapper {\n" + original_code + "\n}"
        else:
            wrapped_code = original_code

        
        # Write the (possibly wrapped) code to a temporary file.
        with tempfile.NamedTemporaryFile(mode='w', suffix='.java', delete=False) as tmp_file:
            tmp_file.write(wrapped_code)
            tmp_path = tmp_file.name

        # Determine the classpath separator (Windows uses ';', others use ':')
        sep = ';' if os.name == 'nt' else ':'
        # Build the classpath: current directory + the JavaParser jar.
        classpath = f".{sep}javaparser-core-3.25.4.jar"

        # Run the precompiled JavaSyntaxChecker using the temporary file.
        result = subprocess.run([
            'java',
            '-cp', classpath,
            'JavaSyntaxChecker',
            tmp_path
        ], stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True)


        print("Java Syntax Checker Output:")
        print(result.stdout)

        if "INVALID" in result.stdout:
            print("❌ Java syntax error:")
            print(result.stderr)
            return False
        else:
            print("✅ Java syntax is valid.")
            return False

    except Exception as e:
        print("Exception:", e)
        return False
    finally:
        if 'tmp_path' in locals() and os.path.exists(tmp_path):
            os.remove(tmp_path)



# .\dataset\java\0044681d77400e1568d1e7b1024a38ec76caa2cb.java

# check_syntax_java('./dataset/java/0044681d77400e1568d1e7b1024a38ec76caa2cb.java')
# loop in dataset/java

for root, dirs, files in os.walk('./dataset/java'):
    for file in files:
        if file.endswith('.java'):
            filepath = os.path.join(root, file)
            print(f"Checking {filepath}...")
            check_syntax_java(filepath)
            print("\n" + "="*40 + "\n")