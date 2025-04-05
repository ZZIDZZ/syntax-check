// JavaSyntaxChecker.java
import com.github.javaparser.*;
import java.io.*;

public class JavaSyntaxChecker {
    public static void main(String[] args) {
        if (args.length < 1) {
            System.out.println("Usage: java JavaSyntaxChecker <JavaFile.java>");
            System.exit(1);
        }

        File file = new File(args[0]);
        try {
            StaticJavaParser.parse(file);
            System.out.println("VALID");
        } catch (ParseProblemException e) {
            System.out.println("INVALID");
            System.err.println(e.getMessage());
            System.exit(2);
        } catch (Exception e) {
            System.out.println("ERROR");
            e.printStackTrace();
            System.exit(3);
        }
    }
}
