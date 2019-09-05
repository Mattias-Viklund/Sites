using System;
using System.Collections.Generic;
using System.IO;
using HTTL.Properties;

// Hyper Text Template Language
namespace HTTL
{
    class Parser
    {
        public static List<string> Errors { get; private set; } = new List<string>();

        private List<string> FilesInDirectory = new List<string>();
        private Dictionary<string, string[]> loadedTemplates = new Dictionary<string, string[]>();
        private string directory;

        public static string[] ValidExtensions;
        public static bool Initialized;

        public Parser(string directory)
        {
            this.directory = directory;

            string[] directories = new string[1];
            directories[0] = directory;

            TraverseDirectoriesAndAddFiles(directories);

        }

        public static void Initialize()
        {
            if (Initialized)
                return;

            string[] validExtensions = Settings.Default.validExtensions.Split(',');
            ValidExtensions = validExtensions;

        }

        public static bool IsValidExtension(string pathExtension)
        {
            if (!Initialized)
                Initialize();

            foreach (string extension in ValidExtensions)
            {
                if (pathExtension == extension)
                    return true;

            }

            return false;

        }

        public void TraverseDirectoriesAndAddFiles(string[] directories, int maxDepth = 5, int currentDepth = 0)
        {
            if (currentDepth == maxDepth)
                return;

            for (int i = 0; i < directories.Length; i++)
            {
                if (Program.ExtendedOutput)
                    Console.WriteLine("Searching directory '" + directories[i] + "'.");
                foreach (string file in Directory.GetFiles(directories[i]))
                {
                    string extension = Path.GetExtension(file);
                    FilesInDirectory.Add(file);

                    if (Program.ExtendedOutput)
                        Console.WriteLine("Found file '" + file + "'");

                }
                TraverseDirectoriesAndAddFiles(Directory.GetDirectories(directories[i]), maxDepth, currentDepth + 1);

            }
        }

        public void Parse()
        {
            List<string> templates = FindTemplates();
            List<string> webFiles = FindWebFiles();

            ParseTemplates(templates);
            ParseWebFiles(webFiles);

            PrintErrors();

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
                loadedTemplates.Add(name.ToLower(), file.ToArray());

            }
        }

        private void ParseWebFiles(List<string> webFiles)
        {
            List<Page> pages = new List<Page>();

            foreach (string s in webFiles)
            {
                string output = GetOutputPath(s);
                Page p = new Page(s, output);

                if (p.Saved)
                {
                    continue;

                }

                if (p.Template == null)
                {
                    Errors.Add("File " + s + " does not contain a template header. Copying as-is.");
                    goto save;

                }

                string[] template;
                if (loadedTemplates.TryGetValue(Path.GetFileNameWithoutExtension(p.Template.ToLower()), out template))
                {
                    p.ApplyTemplate(template);
                    pages.Add(p);

                }
                else
                    Errors.Add("Could not find template referenced in " + s + ", ignoring.");

                save:
                p.Finish();
                if (p.Finished)
                    p.Save(output);

            }
        }

        private string GetOutputPath(string inputPath)
        {
            string output = inputPath.Substring(Program.Input.Length, inputPath.Length - Program.Input.Length);
            output = Program.Output + output;
            if (Program.ExtendedOutput)
                Console.WriteLine("Output path: " + inputPath);
            return output;

        }

        private List<string> FindTemplates()
        {
            List<string> templates = new List<string>();
            for (int i = 0; i < FilesInDirectory.Count; i++)
            {
                if (Path.GetExtension(FilesInDirectory[i]) == Settings.Default.templateExtension)
                {
                    templates.Add(FilesInDirectory[i]);

                }
            }
            return templates;

        }

        private List<string> FindWebFiles()
        {
            List<string> files = new List<string>();

            for (int i = 0; i < FilesInDirectory.Count; i++)
            {
                bool include = false;

                if (Path.GetExtension(FilesInDirectory[i]) != Settings.Default.templateExtension)
                    include = true;

                if (include)
                    files.Add(FilesInDirectory[i]);

            }
            return files;

        }

        public static void PrintErrors()
        {
            foreach (string error in Parser.Errors)
            {
                Console.WriteLine(error);

            }
        }
    }
}
