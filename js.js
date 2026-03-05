const SLUG_CONFIG = {
    а: "a",
    б: "b",
    в: "v",
    г: "g",
    д: "d",
    е: "e",
    ё: "yo",
    ж: "zh",
    з: "z",
    и: "i",
    й: "y",
    к: "k",
    л: "l",
    м: "m",
    н: "n",
    о: "o",
    п: "p",
    р: "r",
    с: "s",
    т: "t",
    у: "u",
    ф: "f",
    х: "kh",
    ц: "ts",
    ч: "ch",
    ш: "sh",
    щ: "shch",
    ъ: "",
    ы: "y",
    ь: "",
    э: "e",
    ю: "yu",
    я: "ya",

    "#": "sharp",
    "+": "plus",
    "&": "and",
    ".": "-",
    _: "-",
    " ": "-",
    "/": "-",
};

const createSlug = (str) => {
    if (typeof str !== "string") return "";

    return str
        .toLowerCase()
        .split("")
        .map((char) => SLUG_CONFIG[char] || char)
        .join("")
        .replace(/[:\s]+/g, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "");
};
