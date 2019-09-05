using System;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

// Hyper Text Template Language
namespace HTTL
{
    class Program
    {
        public static string Input { get; private set; }
        public static string Output { get; private set; }
        private static bool debug = false;
        private static bool close = false;
        public static bool ExtendedOutput { get; private set; } = false;

        // Usage: HTTL.exe [Input Directory], [Output Directory]
        static void Main(string[] args)
        {
            Stopwatch sw = new Stopwatch();
            sw.Start();

            if (args.Length >= 2)
            {
                Console.WriteLine(args.Length+" arguments.");
                Input = args[0];
                Output = args[1];
                if (args.Length > 2)
                {
                    switch (args[2])
                    {
                        case "-c": close = true; Console.WriteLine("(-c), Closing after finish."); break;
                        case "-e": ExtendedOutput = true; Console.WriteLine("(-e), Extended output."); break;

                    }

                    if (args.Length > 3)
                    {
                        switch (args[3])
                        {
                            case "-c": close = true; Console.WriteLine("(-c), Closing after finish."); break;
                            case "-e": ExtendedOutput = true; Console.WriteLine("(-e), Extended output."); break;

                        }
                    }
                }
            }
            else
            {
                if (!debug)
                {
                    Console.WriteLine("Usage: HTTL.exe [Input Directory], [Output Directory], <[-C] Close After Finishing> <[-E] Extended Output>");
                    return;

                }
            }

            if (debug)
            {
                Input = "C:\\Users\\Mew_\\Desktop\\Testing\\Docs";
                Output = "C:\\Users\\Mew_\\Desktop\\Testing\\Build";

            }

            Parser parser = new Parser(Input);
            parser.Parse();

            sw.Stop();

            Console.WriteLine("Build finished!");
            Console.WriteLine("Time elapsed " + sw.ElapsedMilliseconds.ToString() + "ms.");

            if (!close)
                Console.ReadLine();

        }
    }
}
