import os

def main():
    if not os.path.exists("ia_dump.txt"):
        print("ia_dump.txt not found")
        return

    with open("ia_dump.txt", "r", encoding="utf-8") as f:
        lines = f.readlines()

    front_routes = []
    admin_routes = []
    current_group = ""

    for line in lines[3:]:
        cols = line.strip("\n").split("\t")
        if not cols or len(cols) < 5:
            if cols and cols[0].strip():
                current_group = cols[0].strip()
            continue
        
        first_col = cols[0].strip()
        if first_col:
            current_group = first_col
        
        group_type = "admin" if "관리자" in current_group else "front"
        page_id = cols[4].strip()
        
        if not page_id or page_id == "-" or " " in page_id: 
            continue
        
        id_clean = page_id.lower().replace("_", "")
        
        folder = ""
        if "main" in id_clean: folder = "main"
        elif "join" in id_clean: folder = "join"
        elif "login" in id_clean: folder = "login"
        elif "meminfo" in id_clean: folder = "mem-info"
        elif "introdu" in id_clean: folder = "introdu"
        elif "facil" in id_clean: folder = "facil"
        elif "distriinfo" in id_clean: folder = "distri-info"
        elif any(x in id_clean for x in ["memorial", "dead", "letter"]):
            if group_type == "admin":
                folder = "memorial/deadmag" if "dead" in id_clean else "memorial/lettermag"
            else:
                folder = "memorial/deadsearch" if "dead" in id_clean else "memorial/letter"
        elif "customer" in id_clean:
            if "notice" in id_clean: folder = "customer/notice"
            elif "faq" in id_clean: folder = "customer/faq"
            elif "councel" in id_clean: folder = "customer/councel"
            elif "referen" in id_clean: folder = "customer/referen"
            elif "reply" in id_clean: folder = "customer/councel"
            else: folder = "customer"
        elif "admag" in id_clean: folder = "admag"
        elif "memmag" in id_clean: folder = "memmag"
        elif "popup" in id_clean: folder = "popup"
        elif "brochure" in id_clean: folder = "brochure"
        elif any(x in id_clean for x in ["skyscraper", "phone"]): folder = "skyscraper"
        
        if folder:
            view_path = f"{group_type}.{folder.replace('/', '.')}.{page_id}"
            route_line = f"    Route::view('/{page_id}', '{view_path}')->name('{page_id}');"
            if group_type == "admin":
                admin_routes.append(route_line)
            else:
                front_routes.append(route_line)

    output = "<?php\n\nuse Illuminate\Support\Facades\Route;\n\n"
    output += "Route::get('/', function () {\n    return view('welcome');\n});\n\n"
    
    output += "// Front Routes\n"
    output += "Route::group(['prefix' => 'front'], function () {\n"
    output += "\n".join(front_routes)
    output += "\n});\n\n"
    
    output += "// Admin Routes\n"
    output += "Route::group(['prefix' => 'admin'], function () {\n"
    output += "\n".join(admin_routes)
    output += "\n});\n"

    with open("routes/web.php", "w", encoding="utf-8") as f:
        f.write(output)
    print("routes/web.php updated")

if __name__ == "__main__":
    main()
