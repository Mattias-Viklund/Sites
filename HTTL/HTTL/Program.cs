using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;
using HTTL.Properties;

// Hyper Text Template Language
namespace HTTL
{
    class Program
    {
        // Starting Args
        // [1] - Folder Path
        // [2] - Output Path
        static void Main(string[] args)
        {
            Parser parser = new Parser("C:\\Users\\elev\\Desktop\\Sites\\nav\\htdocs");
            string output = "C:\\Users\\elev\\Desktop\\Sites\\nav\\build";
            parser.Parse();

        }
    }

    class Template
    {

    }

    class Parser
    {
        private string directory;
        private string[] filesInDirectory;
        public int FilesInDirectory { get { return this.filesInDirectory.Length; }}
        private Dictionary<string, string[]> loadedTemplates = new Dictionary<string, string[]>();

        public Parser(string directory)
        {
            this.directory = directory;
            filesInDirectory = Directory.GetFiles(directory, "", SearchOption.AllDirectories);

        }

        public void Parse()
        {
            List<string> templates = FindTemplates();
            List<string> webFiles = FindWebFiles(templates);

            ParseTemplates(templates);
            ParseWebFiles(webFiles);

        }

        private void ParseTemplates(List<string> templates)
        {
            string name;
            List<string> file = null;

            foreach (string template in templates)
            {
                name = Path.GetFileNameWithoutExtension(template);
                file = new List<string>();

                using (StreamReader sr = new StreamReader(template))
                {
                    while (!sr.EndOfStream)
                    {
                        file.Add(sr.ReadLine());

                    }
                }
                loadedTemplates.Add(name, file.ToArray());

            }
        }

        private void ParseWebFiles(List<string> webFiles)
        {
            Console.WriteLine("Kek");

        }

        private List<string> FindTemplates()
        {
            List<string> templates = new List<string>();
            for (int i = 0; i < filesInDirectory.Length; i++)
            {
                if (Path.GetExtension(filesInDirectory[i]) == Settings.Default.templateExtension)
                {
                    templates.Add(filesInDirectory[i]);

                }
            }
            return templates;

        }

        private List<string> FindWebFiles(List<string> excludes)
        {
            List<string> files = new List<string>();

            foreach (string s in filesInDirectory)
            {
                bool include = true;
                foreach (string exclude in excludes)
                {
                    if (s == exclude)
                        include = false;

                }

                if (include)
                    files.Add(s);

            }
            return files;

        }
    }
}
