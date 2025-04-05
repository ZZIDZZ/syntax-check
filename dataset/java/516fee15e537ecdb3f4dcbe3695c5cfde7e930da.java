public static void main(String[] args)
  {
    int N = Integer.parseInt(args[0]);
    if (args.length == 2)
      StdRandom.setSeed(Long.parseLong(args[1]));
    double[] t = {.5, .3, .1, .1};
    StdOut.println("seed = " + StdRandom.getSeed());
    for (int i = 0; i < N; i++)
    {
      StdOut.printf("%2d ", uniform(100));
      StdOut.printf("%8.5f ", uniform(10.0, 99.0));
      StdOut.printf("%5b ", bernoulli(.5));
      StdOut.printf("%7.5f ", gaussian(9.0, .2));
      StdOut.printf("%2d ", discrete(t));
      StdOut.println();
    }
    String[] a = "A B C D E F G".split(" ");
    for (String s : a)
      StdOut.print(s + " ");
    StdOut.println();
  }