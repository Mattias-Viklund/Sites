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

        // Usage: HTTL.exe [Input Directory], [Output Directory]
        static void Main(string[] args)
        {
            Stopwatch sw = new Stopwatch();
            sw.Start();

            if (args.Length >= 2)
            {
                Input = args[0];
                Output = args[1];
                if (args.Length > 2)
                {
                    switch (args[2])
                    {
                        case "-c": close = true; break;

                    }
                }
            }
            else
            {
                if (!debug)
                {
                    Console.WriteLine("Usage: HTTL.exe [Input Directory], [Output Directory]");
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
            Console.WriteLine("Total " + sw.ElapsedMilliseconds.ToString() + "ms.");

            if (!close)
                Console.ReadLine();

        }
    }
}
