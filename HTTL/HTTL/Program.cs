using System;
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
        private static bool debug = true;

        // Usage: HTTL.exe [Input Directory], [Output Directory]
        static void Main(string[] args)
        {
            if (args.Length == 2)
            {
                Input = args[0];
                Output = args[1];

            }
            else
            {
                Console.WriteLine("Usage: HTTL.exe [Input Directory], [Output Directory]");

            }

            if (debug)
            {
                Input = "C:\\Users\\Mew_\\Desktop\\Testing\\Docs";
                Output = "C:\\Users\\Mew_\\Desktop\\Testing\\Build";

            }

            Parser parser = new Parser(Input);
            parser.Parse();

        }
    }
}
